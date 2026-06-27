<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - {{ $config['application_name'] ?? 'Talentum' }}</title>
    <style>
        :root {
            --primary-color: {{ $config['primary_color'] ?? '#002741' }};
            --primary-container-color: {{ $config['primary_color'] ?? '#0f3d5e' }};
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen font-body-md text-body-md antialiased overflow-hidden">
<div class="flex min-h-screen w-full">
    <!-- Left Side: Banner -->
    <div class="hidden lg:flex w-1/2 relative bg-surface-container-highest">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover opacity-90 mix-blend-multiply" alt="Banner de inicio de sesión" src="{{ $config['banner'] ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuB0GCPqRfHk17qwRO9ArDGmQnjimcWlSydHNLZPPosOjB7wl4sfjABEYZ63bbQWTpKF4t1350ibna8LW9_jKpDw1CC6XjPNaMQh7RwNXNmK9pB3V0bwMduZ4yQwJj4ZALYfElGZw8SBckCVCr0WaQ-2xrscdj_70LknBDHoHJjI_fKaRlRO5N6DYbXwbA-0oCU7s55OUjx-oFtp_Fe8U-XH2gFdHEWIcHM3L2vcx0v6kaOlBR32mI5_XY47gMD-BkZB0drkFXcmCL6e' }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent"></div>
        </div>
        <div class="relative z-10 flex flex-col justify-end p-2xl text-on-primary w-full h-full">
            <div class="max-w-md">
                <span class="material-symbols-outlined text-4xl mb-md">apartment</span>
                <h2 class="font-headline-lg text-headline-lg mb-sm">Bienvenido a {{ $config['application_name'] ?? 'Talentum' }}</h2>
                <p class="font-body-lg text-body-lg opacity-90">El puente sofisticado entre talento de élite y prestigiosas instituciones.</p>
            </div>
        </div>
    </div>
    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-lg sm:p-2xl bg-surface-container-lowest">
        <div class="w-full max-w-[400px]">
            <!-- Logo -->
            <div class="mb-xl flex items-center justify-center lg:justify-start gap-3">
                @if(!empty($config['logo']))
                    <img src="{{ $config['logo'] }}" alt="Logo" class="h-10 w-auto object-contain">
                @endif
                <span class="font-display-lg text-display-lg text-primary-container tracking-tight leading-none">{{ $config['application_name'] ?? 'Talentum' }}</span>
            </div            <!-- Section: Login -->
            <div id="login-section" class="space-y-md">
                <div class="mb-xl text-center lg:text-left">
                    <h1 class="font-headline-md text-headline-md text-on-surface mb-xs">Iniciar Sesión</h1>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Accede al portal institucional.</p>
                </div>
                <!-- Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-md">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="p-4 rounded-lg bg-error-container text-on-error-container text-body-sm font-medium">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="email">Correo Electrónico Institucional</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">mail</span>
                            <input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/20 focus:border-primary-container transition-all font-body-sm text-body-sm placeholder-outline" id="email" name="email" placeholder="usuario@institucion.edu" type="email" required autocomplete="email" value="{{ old('email') }}"/>
                        </div>
                    </div>
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="password">Contraseña</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">lock</span>
                            <input class="w-full pl-10 pr-10 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/20 focus:border-primary-container transition-all font-body-sm text-body-sm placeholder-outline" id="password" name="password" placeholder="••••••••" type="password" required autocomplete="current-password"/>
                            <button id="toggle-password" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface-variant transition-colors" type="button">
                                <span class="material-symbols-outlined text-xl" id="toggle-icon">visibility_off</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input class="w-4 h-4 rounded border-outline-variant text-primary-container focus:ring-primary-container/20 bg-surface-container-lowest" name="remember" type="checkbox"/>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Recordarme</span>
                        </label>
                        <a class="font-label-sm text-label-sm text-primary-container hover:underline decoration-primary-container/50 transition-all" href="#">Olvidé mi contraseña</a>
                    </div>
                    <button class="w-full mt-xl bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md py-3 px-4 rounded-lg shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2" type="submit">
                        Ingresar
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>
                </form>
                
                <div class="text-center pt-md border-t border-outline-variant/60 mt-md">
                    <span class="font-body-sm text-body-sm text-on-surface-variant">¿Eres una empresa?</span>
                    <button onclick="toggleAuthMode('register')" class="font-label-sm text-label-sm text-primary-container hover:underline ml-1 font-semibold" type="button">Regístrate aquí</button>
                </div>
            </div>

            <!-- Section: Register Company -->
            <div id="register-section" class="space-y-md hidden">
                <div class="mb-xl text-center lg:text-left">
                    <h1 class="font-headline-md text-headline-md text-on-surface mb-xs">Registrar Empresa</h1>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Regístrate con tus datos básicos para comenzar a publicar ofertas.</p>
                </div>
                <!-- Register Form -->
                <form id="register-company-form" onsubmit="handleCompanyRegister(event)" class="space-y-md">
                    @csrf
                    
                    <div id="register-error-container" class="p-4 rounded-lg bg-error-container text-on-error-container text-body-sm font-medium hidden">
                        <p id="register-error-text"></p>
                    </div>

                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="reg-name">Nombre de la Empresa</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">apartment</span>
                            <input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/20 focus:border-primary-container transition-all font-body-sm text-body-sm placeholder-outline" id="reg-name" name="name" placeholder="Ej. Innova Tech SAC" type="text" required />
                        </div>
                    </div>

                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="reg-email">Correo Electrónico Corporativo</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">mail</span>
                            <input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/20 focus:border-primary-container transition-all font-body-sm text-body-sm placeholder-outline" id="reg-email" name="email" placeholder="contacto@empresa.com" type="email" required />
                        </div>
                    </div>

                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="reg-ruc">RUC (11 dígitos)</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">fingerprint</span>
                            <input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/20 focus:border-primary-container transition-all font-body-sm text-body-sm placeholder-outline" id="reg-ruc" name="ruc" placeholder="20123456789" type="text" minlength="11" maxlength="11" pattern="\d{11}" required />
                        </div>
                    </div>

                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="reg-password">Contraseña</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">lock</span>
                            <input class="w-full pl-10 pr-10 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/20 focus:border-primary-container transition-all font-body-sm text-body-sm placeholder-outline" id="reg-password" name="password" placeholder="Mínimo 6 caracteres" type="password" required />
                            <button id="toggle-reg-password" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface-variant transition-colors" type="button">
                                <span class="material-symbols-outlined text-xl" id="toggle-reg-icon">visibility_off</span>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="reg-password-confirm">Confirmar Contraseña</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">lock</span>
                            <input class="w-full pl-10 pr-10 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container/20 focus:border-primary-container transition-all font-body-sm text-body-sm placeholder-outline" id="reg-password-confirm" name="password_confirmation" placeholder="••••••••" type="password" required />
                            <button id="toggle-reg-password-confirm" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface-variant transition-colors" type="button">
                                <span class="material-symbols-outlined text-xl" id="toggle-reg-icon-confirm">visibility_off</span>
                            </button>
                        </div>
                    </div>

                    <button id="btn-register-company" class="w-full mt-xl bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md py-3 px-4 rounded-lg shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2" type="submit">
                        Registrar Empresa
                        <span class="material-symbols-outlined text-sm">how_to_reg</span>
                    </button>
                </form>
                
                <div class="text-center pt-md border-t border-outline-variant/60 mt-md">
                    <span class="font-body-sm text-body-sm text-on-surface-variant">¿Ya tienes cuenta?</span>
                    <button onclick="toggleAuthMode('login')" class="font-label-sm text-label-sm text-primary-container hover:underline ml-1 font-semibold" type="button">Inicia sesión</button>
                </div>
            </div>

            <!-- Footer / Security -->
            <div class="mt-2xl text-center border-t border-outline-variant pt-lg">
                <div class="flex items-center justify-center gap-2 text-on-surface-variant mb-xs">
                    <span class="material-symbols-outlined text-sm filled">verified_user</span>
                    <span class="font-label-sm text-label-sm">Conexión Segura</span>
                </div>
                <p class="font-body-sm text-body-sm text-outline text-[12px]">Este portal está protegido por políticas de seguridad institucionales.</p>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification Element -->
<div id="toast" class="fixed bottom-5 right-5 bg-primary text-on-primary px-lg py-md rounded-xl shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-sm">
    <span class="material-symbols-outlined" id="toast-icon">check_circle</span>
    <span id="toast-message" class="font-label-md text-label-md"></span>
</div>

<script>
    function toggleAuthMode(mode) {
        const loginSec = document.getElementById('login-section');
        const regSec = document.getElementById('register-section');
        
        if (mode === 'register') {
            loginSec.classList.add('hidden');
            regSec.classList.remove('hidden');
            document.getElementById('register-company-form').reset();
            document.getElementById('register-error-container').classList.add('hidden');
        } else {
            regSec.classList.add('hidden');
            loginSec.classList.remove('hidden');
        }
    }

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-message');
        const toastIcon = document.getElementById('toast-icon');
        
        toastMsg.textContent = message;
        
        if (type === 'error') {
            toast.className = "fixed bottom-5 right-5 bg-red-600 text-on-primary px-lg py-md rounded-xl shadow-lg transform transition-all duration-300 z-50 flex items-center gap-sm";
            toastIcon.textContent = 'error';
        } else {
            toast.className = "fixed bottom-5 right-5 bg-primary text-on-primary px-lg py-md rounded-xl shadow-lg transform transition-all duration-300 z-50 flex items-center gap-sm";
            toastIcon.textContent = 'check_circle';
        }
        
        toast.classList.remove('translate-y-20', 'opacity-0');
        
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
        }, 3000);
    }

    function handleCompanyRegister(event) {
        event.preventDefault();
        
        const form = document.getElementById('register-company-form');
        const btn = document.getElementById('btn-register-company');
        const errContainer = document.getElementById('register-error-container');
        const errText = document.getElementById('register-error-text');
        
        const name = document.getElementById('reg-name').value;
        const email = document.getElementById('reg-email').value;
        const ruc = document.getElementById('reg-ruc').value;
        const password = document.getElementById('reg-password').value;
        const password_confirmation = document.getElementById('reg-password-confirm').value;
        const token = form.querySelector('input[name="_token"]').value;
        
        if (password !== password_confirmation) {
            errText.textContent = 'Las contraseñas no coinciden.';
            errContainer.classList.remove('hidden');
            return;
        }
        
        btn.setAttribute('disabled', 'true');
        btn.innerHTML = `<span class="material-symbols-outlined animate-spin">autorenew</span> Registrando...`;
        errContainer.classList.add('hidden');
        
        fetch('/register/company', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ name, email, ruc, password, password_confirmation })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast('¡Registro exitoso! Redirigiendo...');
                setTimeout(() => {
                    window.location.href = '/company/dashboard';
                }, 1500);
            } else {
                btn.removeAttribute('disabled');
                btn.innerHTML = 'Registrar Empresa <span class="material-symbols-outlined text-sm">how_to_reg</span>';
                errText.textContent = data.message || 'Error al registrar la empresa.';
                errContainer.classList.remove('hidden');
            }
        })
        .catch(err => {
            btn.removeAttribute('disabled');
            btn.innerHTML = 'Registrar Empresa <span class="material-symbols-outlined text-sm">how_to_reg</span>';
            errText.textContent = 'Error de red. Intente de nuevo más tarde.';
            errContainer.classList.remove('hidden');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-icon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
        });

        // Register form password toggles
        const toggleRegPass = document.getElementById('toggle-reg-password');
        const regPassInput = document.getElementById('reg-password');
        const toggleRegPassIcon = document.getElementById('toggle-reg-icon');
        
        toggleRegPass.addEventListener('click', function() {
            const type = regPassInput.getAttribute('type') === 'password' ? 'text' : 'password';
            regPassInput.setAttribute('type', type);
            toggleRegPassIcon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
        });

        const toggleRegPassConfirm = document.getElementById('toggle-reg-password-confirm');
        const regPassConfirmInput = document.getElementById('reg-password-confirm');
        const toggleRegPassConfirmIcon = document.getElementById('toggle-reg-icon-confirm');
        
        toggleRegPassConfirm.addEventListener('click', function() {
            const type = regPassConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
            regPassConfirmInput.setAttribute('type', type);
            toggleRegPassConfirmIcon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
        });
    });
</script>
</body>
</html>
