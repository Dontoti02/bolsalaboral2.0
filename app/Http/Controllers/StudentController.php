<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunityApplication;
use App\Models\JobOpportunityOffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Show the student dashboard with real data.
     */
    public function dashboard()
    {
        $user = Auth::user();

        try {
            // Student applications metrics
            $totalApplications = JobOpportunityApplication::where('user_id', $user->id)->count();
            $pendingApplications = JobOpportunityApplication::where('user_id', $user->id)
                ->whereIn('status', ['postulated', 'under_review'])
                ->count();
            $acceptedApplications = JobOpportunityApplication::where('user_id', $user->id)
                ->where('status', 'accepted')
                ->count();

            // Recent applications for this student
            $recentApplications = JobOpportunityApplication::where('user_id', $user->id)
                ->with(['offer' => function ($q) {
                    $q->with('company:id,name');
                }])
                ->orderBy('created_at', 'desc')
                ->get();

            // All active offers (recommended jobs)
            $activeOffers = JobOpportunityOffer::with(['company:id,name,logo', 'state', 'category', 'workSchedule', 'location', 'contractType'])
                ->whereHas('state', function ($q) {
                    $q->where('key', 'active');
                })
                ->orderBy('publication_date', 'desc')
                ->take(6)
                ->get()
                ->map(function ($offer) {
                    $offer->location_name = $offer->location->name ?? 'No especificada';
                    $offer->company_name = $offer->company->name ?? 'Empresa';
                    return $offer;
                });

            // Retrieve student's CVs
            $cvs = DB::table('job_opportunity_user_cv')
                ->where('user_id', $user->id)
                ->whereNull('deleted_at')
                ->orderBy('version', 'desc')
                ->get()
                ->map(function ($cv) {
                    $cv->filename = basename($cv->url);
                    $cv->uploaded_at = $cv->created_at ? \Carbon\Carbon::parse($cv->created_at)->format('d M Y') : '-';
                    return $cv;
                });
            $cvsCount = $cvs->count();

        } catch (\Exception $e) {
            $totalApplications = 0;
            $pendingApplications = 0;
            $acceptedApplications = 0;
            $recentApplications = collect();
            $activeOffers = collect();
            $cvsCount = 0;
            $cvs = collect();
        }

        try {
            $config = \Illuminate\Support\Facades\DB::table('system_configuration')->pluck('value', 'key')->all();
        } catch (\Exception $e) {
            $config = [];
        }

        return view('student.dashboard', compact(
            'totalApplications',
            'pendingApplications',
            'acceptedApplications',
            'recentApplications',
            'activeOffers',
            'cvsCount',
            'cvs',
            'config'
        ));
    }

    /**
     * Upload a new CV.
     */
    public function uploadCv(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cv' => 'required|file|mimes:pdf|max:5120',
        ], [
            'cv.required' => 'El archivo del currículum es obligatorio.',
            'cv.mimes' => 'El currículum debe ser un archivo PDF.',
            'cv.max' => 'El tamaño del currículum no debe exceder los 5MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $file = $request->file('cv');
            $filename = 'cv_' . auth()->id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('uploads/cvs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $filename);
            $url = '/uploads/cvs/' . $filename;
            
            // Calculate next version
            $latestVersion = DB::table('job_opportunity_user_cv')
                ->where('user_id', auth()->id())
                ->max('version') ?? 0;
            
            $id = DB::table('job_opportunity_user_cv')->insertGetId([
                'user_id' => auth()->id(),
                'url' => $url,
                'version' => $latestVersion + 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Currículum subido exitosamente.',
                'cv' => [
                    'id' => $id,
                    'url' => $url,
                    'version' => $latestVersion + 1,
                    'filename' => $file->getClientOriginalName(),
                    'uploaded_at' => now()->format('d M Y')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir currículum: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a CV (soft-delete).
     */
    public function deleteCv($id)
    {
        try {
            $cv = DB::table('job_opportunity_user_cv')
                ->where('id', $id)
                ->where('user_id', auth()->id())
                ->first();

            if (!$cv) {
                return response()->json([
                    'success' => false,
                    'message' => 'Currículum no encontrado o no pertenece a su usuario.'
                ], 404);
            }

            DB::table('job_opportunity_user_cv')
                ->where('id', $id)
                ->update([
                    'deleted_at' => now(),
                    'updated_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Currículum eliminado exitosamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar currículum: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download a CV.
     */
    public function downloadCv($id)
    {
        $cv = DB::table('job_opportunity_user_cv')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->whereNull('deleted_at')
            ->first();

        if (!$cv) {
            abort(404, 'Currículum no encontrado.');
        }

        $filePath = public_path($cv->url);
        if (!file_exists($filePath)) {
            abort(404, 'El archivo físico del currículum no existe.');
        }

        return response()->download($filePath);
    }

    /**
     * Apply to a job offer.
     */
    public function applyToOffer(Request $request, $offer_id)
    {
        $validator = Validator::make($request->all(), [
            'cv_id' => 'required|integer',
            'message' => 'nullable|string|max:1000',
        ], [
            'cv_id.required' => 'Debe seleccionar un currículum para postular.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            $user = auth()->user();
            $person = $user->person;

            if (!$person) {
                return response()->json([
                    'success' => false,
                    'message' => 'Debe completar sus datos personales primero.'
                ], 400);
            }

            // Validate CV ownership
            $cv = DB::table('job_opportunity_user_cv')
                ->where('id', $request->cv_id)
                ->where('user_id', $user->id)
                ->whereNull('deleted_at')
                ->first();

            if (!$cv) {
                return response()->json([
                    'success' => false,
                    'message' => 'El currículum seleccionado no es válido.'
                ], 400);
            }

            // Check if already applied
            $alreadyApplied = JobOpportunityApplication::where('user_id', $user->id)
                ->where('offer_id', $offer_id)
                ->exists();

            if ($alreadyApplied) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya ha postulado a esta oferta laboral.'
                ], 400);
            }

            JobOpportunityApplication::create([
                'fullname' => $person->names,
                'program_study' => 'Computación y Sistemas', // default study program
                'message' => $request->message ?? '',
                'status' => 'postulated', // Initial status
                'cv' => $cv->url,
                'offer_id' => $offer_id,
                'user_id' => $user->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => '¡Postulación enviada exitosamente!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar postulación: ' . $e->getMessage()
            ], 500);
        }
    }
}