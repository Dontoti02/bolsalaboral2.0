<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->rol_id == 1) {
                return redirect()->intended('/admin/dashboard');
            } elseif (Auth::user()->rol_id == 2) {
                return redirect()->intended('/teacher/dashboard');
            } elseif (Auth::user()->rol_id == 3) {
                return redirect()->intended('/student/dashboard');
            } elseif (Auth::user()->rol_id == 4) {
                return redirect()->intended('/company/dashboard');
            }
        }
        try {
            $config = \Illuminate\Support\Facades\DB::table('system_configuration')->pluck('value', 'key')->all();
        } catch (\Exception $e) {
            $config = [];
        }
        return view('login', compact('config'));
    }

    /**
     * Handle authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor, ingrese un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // Add active state requirement
        $credentials['is_active'] = 1;

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on user role
            if ($user->rol_id == 1) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->rol_id == 2) {
                return redirect()->intended('/teacher/dashboard');
            } elseif ($user->rol_id == 3) {
                return redirect()->intended('/student/dashboard');
            } elseif ($user->rol_id == 4) {
                return redirect()->intended('/company/dashboard');
            }

            // If user has some other role that is not permitted
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return back()->withErrors([
                'email' => 'Acceso denegado. Rol de usuario no autorizado para este portal.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'El correo electrónico o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }

    /**
     * Handle company registration.
     */
    public function registerCompany(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'ruc' => 'required|string|size:11|unique:job_opportunity_company,ruc',
            'email' => 'required|email|max:255|unique:user,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'El nombre de la empresa es obligatorio.',
            'ruc.required' => 'El RUC es obligatorio.',
            'ruc.size' => 'El RUC debe tener exactamente 11 dígitos.',
            'ruc.unique' => 'Este RUC ya está registrado.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            // Create company with basic data
            $company = \App\Models\Company::create([
                'name' => $request->name,
                'ruc' => $request->ruc,
                'email' => $request->email,
                'phone' => '',
                'mailbox' => $request->email,
                'is_verified' => true,
            ]);

            // Create user for the company with RUC as password
            $user = new \App\Models\User();
            $user->company_id = $company->id;
            $user->rol_id = 4; // Empresa
            $user->email = $request->email;
            $user->password = \Illuminate\Support\Facades\Hash::make($request->ruc); // RUC as password
            $user->is_active = true;
            $user->attempts = 0;
            $user->save();

            // Insert into legacy/related role_user table
            \Illuminate\Support\Facades\DB::table('rol_user')->insert([
                'rol_id' => 4,
                'user_id' => $user->id
            ]);

            \Illuminate\Support\Facades\DB::commit();

            // Log the user in directly
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Empresa registrada y autenticada exitosamente.'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error durante el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
