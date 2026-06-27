<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunityApplication;
use App\Models\JobOpportunityOffer;
use Illuminate\Support\Facades\Auth;

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
                ->take(5)
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

            // Count CVs (we can count from applications that have a CV attached, or from a cvs table if it exists)
            $cvsCount = JobOpportunityApplication::where('user_id', $user->id)
                ->whereNotNull('cv')
                ->count();

        } catch (\Exception $e) {
            $totalApplications = 0;
            $pendingApplications = 0;
            $acceptedApplications = 0;
            $recentApplications = collect();
            $activeOffers = collect();
            $cvsCount = 0;
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
            'config'
        ));
    }
}