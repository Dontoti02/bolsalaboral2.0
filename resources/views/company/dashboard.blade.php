<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Talentum - Panel de Empresa</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-surface": "#191c1e",
                        "surface-container": "#eceef1",
                        "surface-tint": "#3a6285",
                        "error-container": "#ffdad6",
                        "primary-fixed": "#cee5ff",
                        "tertiary-container": "#4c3700",
                        "surface-container-low": "#f2f4f7",
                        "outline-variant": "#c2c7ce",
                        "surface-dim": "#d8dadd",
                        "on-primary-fixed": "#001d33",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "primary-container": "#0f3d5e",
                        "inverse-surface": "#2d3133",
                        "surface-container-high": "#e6e8eb",
                        "on-secondary-fixed-variant": "#005048",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed": "#251a00",
                        "primary-fixed-dim": "#a3caf2",
                        "secondary-fixed": "#7df7e4",
                        "inverse-on-surface": "#eff1f4",
                        "tertiary-fixed-dim": "#f9bd14",
                        "outline": "#72777e",
                        "on-surface-variant": "#42474e",
                        "on-tertiary-container": "#d09c00",
                        "error": "#ba1a1a",
                        "on-secondary": "#ffffff",
                        "secondary-fixed-dim": "#5edac8",
                        "inverse-primary": "#a3caf2",
                        "tertiary-fixed": "#ffdf9d",
                        "secondary": "#006b60",
                        "surface-container-highest": "#e0e3e6",
                        "on-secondary-fixed": "#00201c",
                        "surface-bright": "#f7f9fc",
                        "background": "#f7f9fc",
                        "surface-variant": "#e0e3e6",
                        "on-background": "#191c1e",
                        "secondary-container": "#7df7e4",
                        "on-primary-fixed-variant": "#204a6b",
                        "on-primary": "#ffffff",
                        "primary": "#002741",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed-variant": "#5b4300",
                        "on-secondary-container": "#007166",
                        "tertiary": "#312200",
                        "on-primary-container": "#81a8ce",
                        "surface": "#f7f9fc"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1280px",
                        "3xl": "64px",
                        "xl": "32px",
                        "xs": "4px",
                        "sm": "8px",
                        "base": "4px",
                        "lg": "24px",
                        "2xl": "48px",
                        "md": "16px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Manrope"],
                        "headline-lg": ["Manrope"],
                        "display-lg": ["Manrope"],
                        "body-lg": ["Inter"],
                        "headline-md": ["Manrope"],
                        "label-sm": ["Inter"],
                        "body-sm": ["Inter"],
                        "body-md": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-sm": ["Manrope"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fc; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex">

    @php
        $sidebarConfig = [
            'logo' => $config['logo'] ?? '/assets/logo.png',
            'brand' => 'Talentum',
            'subtitle' => 'Portal de Empresas',
            'active' => '',
            'home_tab' => 'dashboard',
            'show_publish' => true,
            'publish_tab' => 'offers',
            'publish_label' => 'Publicar Oferta',
            'show_help' => true,
            'help_label' => 'Centro de Ayuda',
            'items' => [
                [
                    'label' => '',
                    'items' => [
                        ['key' => 'dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard'],
                        ['key' => 'offers', 'icon' => 'work', 'label' => 'Gestionar Ofertas'],
                        ['key' => 'applicants', 'icon' => 'group', 'label' => 'Postulantes'],
                        ['key' => 'profile', 'icon' => 'domain', 'label' => 'Perfil de Empresa'],
                    ],
                ],
            ],
        ];
    @endphp

    @include('partials.sidebar', ['sidebarConfig' => $sidebarConfig, 'config' => $config ?? []])

    

<!-- Main Content Wrapper -->
<div class="flex-1 flex flex-col ml-0 md:ml-0 w-full min-h-screen">
    <!-- TopNavBar -->
    <header class="sticky top-0 right-0 w-full bg-surface-bright border-b border-outline-variant z-20 h-[72px]">
        <div class="flex justify-between items-center px-lg py-md h-full">
            <!-- Search and Mobile Toggle -->
            <div class="flex items-center gap-4 flex-1 max-w-md">
                <!-- Mobile Menu Trigger -->
                <button id="open-sidebar-btn" class="md:hidden text-on-surface-variant hover:bg-surface-container-high p-2 rounded-full">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="relative w-full hidden md:block">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Buscar..." type="text">
                </div>
            </div>
            <!-- Trailing Actions & Profile -->
            <div class="flex items-center gap-md">
                <button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 transition-all">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 transition-all">
                    <span class="material-symbols-outlined">help</span>
                </button>
                <div class="w-px h-6 bg-outline-variant mx-sm"></div>
                
                <div class="flex items-center gap-3 ml-sm">
                    <div class="text-right hidden sm:block">
                        <p id="header-company-name" class="text-label-md font-semibold text-on-surface leading-none">{{ $company->name }}</p>
                        <span class="text-[11px] text-on-surface-variant">Portal Corporativo</span>
                    </div>
                    <div class="w-10 h-10 rounded-full overflow-hidden border border-outline-variant bg-primary-container text-on-primary flex items-center justify-center font-bold relative shrink-0">
                        @if(!empty($company->logo))
                            <img id="header-logo" src="{{ $company->logo }}" alt="Logo" class="w-full h-full object-cover">
                        @else
                            <div id="header-initials" class="w-full h-full flex items-center justify-center bg-primary-container text-on-primary font-bold">
                                {{ strtoupper(substr($company->name ?? 'C', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Dashboard Canvas -->
    <main class="flex-1 p-lg md:p-2xl w-full max-w-container-max mx-auto">
        
        <!-- ================= PANEL 1: DASHBOARD OVERVIEW ================= -->
        <div id="panel-dashboard" class="tab-panel space-y-xl">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-md">
                <div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Resumen de Empresa</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant">Monitorea el rendimiento de tus ofertas y postulantes.</p>
                </div>
                <button onclick="switchTab('offers')" class="bg-primary text-on-primary rounded-lg px-lg py-3 font-label-md text-label-md flex items-center justify-center gap-sm shadow-sm hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Crear Nueva Oferta
                </button>
            </div>

            @if(empty($company->phone) || empty($company->address))
            <!-- Warning Banner -->
            <div id="profile-warning-banner" class="flex flex-col sm:flex-row sm:items-center justify-between gap-md bg-yellow-50 border-2 border-yellow-200 text-yellow-900 p-lg rounded-2xl shadow-sm">
                <div class="flex items-start gap-md">
                    <span class="material-symbols-outlined text-yellow-600 text-3xl shrink-0">warning</span>
                    <div>
                        <p class="font-bold text-body-sm leading-none text-yellow-950">¡Perfil Incompleto!</p>
                        <p class="text-body-sm mt-1">Completa la información detallada de tu empresa (teléfono, dirección, logo, etc.) para que los postulantes conozcan más sobre tu marca empleadora.</p>
                    </div>
                </div>
                <button onclick="switchTab('profile')" class="px-5 py-2.5 bg-yellow-600 text-white font-label-md text-label-md rounded-xl hover:bg-yellow-700 transition-colors shadow-sm whitespace-nowrap font-semibold">
                    Completar Perfil
                </button>
            </div>
            @endif
            
            <!-- Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-md">
                <!-- Metric 1 -->
                <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-md">
                        <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">publish</span>
                        </div>
                    </div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-xs">Ofertas Publicadas</p>
                    <h3 class="font-display-lg text-display-lg text-on-surface">{{ $offersCount }}</h3>
                </div>
                <!-- Metric 2 -->
                <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-md">
                        <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-secondary">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                    </div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-xs">Ofertas Activas</p>
                    <h3 class="font-display-lg text-display-lg text-on-surface">{{ $activeOffersCount }}</h3>
                </div>
                <!-- Metric 3 -->
                <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-md">
                        <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container">
                            <span class="material-symbols-outlined">groups</span>
                        </div>
                    </div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-xs">Postulantes Recibidos</p>
                    <h3 class="font-display-lg text-display-lg text-on-surface">{{ $applicantsCount }}</h3>
                </div>
                <!-- Metric 4 -->
                <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-md">
                        <div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center text-on-error-container">
                            <span class="material-symbols-outlined">pending_actions</span>
                        </div>
                    </div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-xs">Pendientes</p>
                    <h3 class="font-display-lg text-display-lg text-on-surface">{{ $pendingApplicantsCount }}</h3>
                </div>
            </div>
            
            <!-- Tables Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-lg">
                <!-- Últimas Ofertas Table -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col h-full">
                    <div class="px-lg py-md border-b border-outline-variant flex justify-between items-center bg-surface-bright">
                        <h3 class="font-headline-sm text-headline-sm text-on-surface">Últimas Ofertas</h3>
                        <button onclick="switchTab('offers')" class="text-primary font-label-sm text-label-sm hover:underline">Ver todas</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-outline-variant bg-surface-container-lowest">
                                    <th class="px-lg py-sm font-label-sm text-label-sm text-on-surface-variant font-semibold">Título</th>
                                    <th class="px-lg py-sm font-label-sm text-label-sm text-on-surface-variant font-semibold">Fecha</th>
                                    <th class="px-lg py-sm font-label-sm text-label-sm text-on-surface-variant font-semibold text-center">Postulantes</th>
                                    <th class="px-lg py-sm font-label-sm text-label-sm text-on-surface-variant font-semibold text-right">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOffers as $offer)
                                <tr class="border-b border-surface-container-high hover:bg-surface-container-lowest transition-colors group">
                                    <td class="px-lg py-md font-body-sm text-body-sm text-on-surface font-medium">{{ $offer->title }}</td>
                                    <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">{{ $offer->publication_date ? $offer->publication_date->format('d M, Y') : '-' }}</td>
                                    <td class="px-lg py-md font-body-sm text-body-sm text-on-surface text-center">{{ $offer->applicants_count ?? 0 }}</td>
                                    <td class="px-lg py-md text-right">
                                        @php
                                            $stateName = $offer->state->name ?? 'Desconocido';
                                            $stateKey = $offer->state->key ?? '';
                                            $stateClass = 'bg-surface-container text-on-surface-variant';
                                            if ($stateKey === 'active') $stateClass = 'bg-secondary-container text-on-secondary-container';
                                            elseif ($stateKey === 'draft') $stateClass = 'bg-tertiary-fixed text-on-tertiary-fixed-variant';
                                            elseif ($stateKey === 'finished') $stateClass = 'bg-surface-container text-on-surface-variant';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm {{ $stateClass }}">{{ $stateName }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-lg py-md text-center text-on-surface-variant">No hay ofertas publicadas aún.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Últimos Postulantes Table -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col h-full">
                    <div class="px-lg py-md border-b border-outline-variant flex justify-between items-center bg-surface-bright">
                        <h3 class="font-headline-sm text-headline-sm text-on-surface">Últimos Postulantes</h3>
                        <button onclick="switchTab('applicants')" class="text-primary font-label-sm text-label-sm hover:underline">Ver todos</button>
                    </div>
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-outline-variant bg-surface-container-lowest">
                                    <th class="px-lg py-sm font-label-sm text-label-sm text-on-surface-variant font-semibold">Nombre</th>
                                    <th class="px-lg py-sm font-label-sm text-label-sm text-on-surface-variant font-semibold">Puesto Aplicado</th>
                                    <th class="px-lg py-sm font-label-sm text-label-sm text-on-surface-variant font-semibold">Fecha</th>
                                    <th class="px-lg py-sm font-label-sm text-label-sm text-on-surface-variant font-semibold text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentApplicants as $app)
                                <tr class="border-b border-surface-container-high hover:bg-surface-container-lowest transition-colors group">
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-sm">
                                            <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-label-sm text-label-sm font-bold">{{ strtoupper(substr($app->fullname ?? 'C', 0, 1)) }}{{ isset($app->fullname) && strlen($app->fullname) > 1 ? strtoupper(substr(str_replace(' ', '', $app->fullname), 1, 1)) : 'A' }}</div>
                                            <span class="font-body-sm text-body-sm text-on-surface font-medium">{{ $app->fullname ?? 'Candidato' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">{{ $app->offer_title ?? 'Puesto' }}</td>
                                    <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">{{ $app->created_at ? \Carbon\Carbon::parse($app->created_at)->diffForHumans() : '-' }}</td>
                                    <td class="px-lg py-md text-right">
                                        <button class="text-primary hover:text-primary-container font-label-md text-label-md transition-colors font-semibold">Ver Perfil</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-lg py-md text-center text-on-surface-variant">No hay postulantes aún.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ================= PANEL 2: GESTIONAR OFERTAS ================= -->
        <div id="panel-offers" class="tab-panel space-y-xl hidden">
            <!-- Header with Action -->
            <div class="flex justify-between items-center">
                <h2 class="text-headline-sm font-headline-sm text-on-surface">Gestionar Ofertas de Empleo</h2>
                <button class="bg-primary text-on-primary rounded-lg px-md py-2.5 font-label-md text-label-md flex items-center gap-sm shadow-sm hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Publicar Oferta
                </button>
            </div>
            
            <!-- Active Offers Grid -->
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-outline-variant bg-surface-container-low">
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold">Título de Oferta</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold">Ubicación</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold">Fecha de Publicación</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold text-center">Postulantes</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold text-right">Estado</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-surface-container-high hover:bg-surface-container-lowest transition-colors">
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface font-semibold">Senior Backend Engineer</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Lima, Perú (Híbrido)</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">24 Oct 2023</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface text-center">24</td>
                                <td class="px-lg py-md text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-secondary-container text-on-secondary-container font-semibold">Activa</span>
                                </td>
                                <td class="px-lg py-md text-right">
                                    <button class="text-primary hover:underline font-label-sm text-label-sm font-semibold">Editar</button>
                                </td>
                            </tr>
                            <tr class="border-b border-surface-container-high hover:bg-surface-container-lowest transition-colors">
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface font-semibold">Product Manager</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Remoto</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">20 Oct 2023</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface text-center">15</td>
                                <td class="px-lg py-md text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-secondary-container text-on-secondary-container font-semibold">Activa</span>
                                </td>
                                <td class="px-lg py-md text-right">
                                    <button class="text-primary hover:underline font-label-sm text-label-sm font-semibold">Editar</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-container-lowest transition-colors">
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface font-semibold">UX Designer Jr.</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Lima, Perú (Presencial)</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">15 Oct 2023</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface text-center">6</td>
                                <td class="px-lg py-md text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-surface-container text-on-surface-variant font-semibold">Cerrada</span>
                                </td>
                                <td class="px-lg py-md text-right">
                                    <button class="text-primary hover:underline font-label-sm text-label-sm font-semibold">Reabrir</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= PANEL 3: POSTULANTES ================= -->
        <div id="panel-applicants" class="tab-panel space-y-xl hidden">
            <h2 class="text-headline-sm font-headline-sm text-on-surface">Candidatos Postulados</h2>
            
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-outline-variant bg-surface-container-low">
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold">Postulante</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold">Puesto Aplicado</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold">Fecha</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold">Contacto</th>
                                <th class="px-lg py-md font-label-sm text-label-sm text-on-surface-variant font-semibold text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-surface-container-high hover:bg-surface-container-lowest transition-colors">
                                <td class="px-lg py-md">
                                    <div class="flex items-center gap-sm">
                                        <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold text-label-sm">CM</div>
                                        <div>
                                            <span class="font-body-sm text-body-sm text-on-surface font-semibold block">Carlos Mendoza</span>
                                            <span class="text-[11px] text-on-surface-variant">Estudiante de Computación</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Senior Backend Engineer</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Hace 2 horas</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">carlos@mendoza.edu.pe</td>
                                <td class="px-lg py-md text-right">
                                    <button class="text-primary hover:underline font-label-sm text-label-sm font-semibold">Ver Perfil</button>
                                </td>
                            </tr>
                            <tr class="border-b border-surface-container-high hover:bg-surface-container-lowest transition-colors">
                                <td class="px-lg py-md">
                                    <div class="flex items-center gap-sm">
                                        <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold text-label-sm">LR</div>
                                        <div>
                                            <span class="font-body-sm text-body-sm text-on-surface font-semibold block">Laura Ríos</span>
                                            <span class="text-[11px] text-on-surface-variant">Estudiante de Administración</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Product Manager</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Hace 5 horas</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">laura.rios@gmail.com</td>
                                <td class="px-lg py-md text-right">
                                    <button class="text-primary hover:underline font-label-sm text-label-sm font-semibold">Ver Perfil</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-container-lowest transition-colors">
                                <td class="px-lg py-md">
                                    <div class="flex items-center gap-sm">
                                        <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold text-label-sm">JV</div>
                                        <div>
                                            <span class="font-body-sm text-body-sm text-on-surface font-semibold block">Javier Vargas</span>
                                            <span class="text-[11px] text-on-surface-variant">Estudiante de Sistemas</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Senior Backend Engineer</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">Ayer</td>
                                <td class="px-lg py-md font-body-sm text-body-sm text-on-surface-variant">j.vargas@outlook.com</td>
                                <td class="px-lg py-md text-right">
                                    <button class="text-primary hover:underline font-label-sm text-label-sm font-semibold">Ver Perfil</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= PANEL 4: PERFIL DE EMPRESA ================= -->
        <div id="panel-profile" class="tab-panel space-y-xl hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-headline-sm font-headline-sm text-on-surface mb-xs">Perfil de la Empresa</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">Gestiona la información corporativa visible para los postulantes.</p>
                </div>
            </div>

            <!-- Profile form -->
            <form id="company-profile-form" onsubmit="handleProfileSubmit(event)" class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg space-y-lg shadow-sm" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                    <!-- Nombre de la empresa -->
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="prof-name">Nombre de la Empresa *</label>
                        <input class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-body-sm text-body-sm" id="prof-name" name="name" value="{{ $company->name }}" type="text" required />
                    </div>

                    <!-- RUC (lectura únicamente) -->
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="prof-ruc">RUC *</label>
                        <input class="w-full px-4 py-2.5 bg-surface-container border border-outline-variant rounded-xl outline-none transition-all font-body-sm text-body-sm text-on-surface-variant cursor-not-allowed" id="prof-ruc" value="{{ $company->ruc }}" type="text" readonly />
                    </div>

                    <!-- Email de la empresa -->
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="prof-email">Email *</label>
                        <input class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-body-sm text-body-sm" id="prof-email" name="email" value="{{ $company->email }}" type="email" required />
                    </div>

                    <!-- Teléfono -->
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="prof-phone">Teléfono *</label>
                        <input class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-body-sm text-body-sm" id="prof-phone" name="phone" value="{{ $company->phone }}" placeholder="Ej: (01) 1234-5678" type="text" required />
                    </div>

                    <!-- Dirección -->
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="prof-address">Dirección *</label>
                        <input class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-body-sm text-body-sm" id="prof-address" name="address" value="{{ $company->address }}" placeholder="Ej: Av. Siempre Viva 123" type="text" required />
                    </div>

                    <!-- Buzón de Correo -->
                    <div class="space-y-xs">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="prof-mailbox">Buzón de Correo (Recepción de postulaciones)</label>
                        <input class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-body-sm text-body-sm" id="prof-mailbox" name="mailbox" value="{{ $company->mailbox }}" placeholder="Correo donde se recibirán las postulaciones" type="email" />
                    </div>

                    <!-- Página Web -->
                    <div class="space-y-xs md:col-span-2">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="prof-website">Página Web</label>
                        <input class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-body-sm text-body-sm" id="prof-website" name="website" value="{{ $company->website }}" placeholder="Página web de la empresa" type="url" />
                    </div>

                    <!-- Acerca de la empresa -->
                    <div class="space-y-xs md:col-span-2">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block" for="prof-description">Acerca de la empresa</label>
                        <textarea class="w-full px-4 py-2.5 bg-background border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-body-sm text-body-sm" id="prof-description" name="description" rows="4" placeholder="Descripción de la empresa">{{ $company->description }}</textarea>
                    </div>

                    <!-- Logotipo -->
                    <div class="space-y-sm md:col-span-2 border-t border-outline-variant pt-lg">
                        <label class="font-label-sm text-label-sm text-on-surface-variant block">Logotipo de la Empresa</label>
                        <div class="flex items-center gap-lg">
                            <div class="w-24 h-24 rounded-2xl overflow-hidden border border-outline-variant bg-surface flex items-center justify-center shrink-0">
                                <img id="logo-preview-image" src="{{ $company->logo ?? 'https://via.placeholder.com/150?text=Sin+Logo' }}" alt="Logo Preview" class="w-full h-full object-contain">
                            </div>
                            <div class="space-y-xs">
                                <input type="file" id="logo-file-input" name="logo" class="hidden" accept="image/*" onchange="previewLogoImage(this)">
                                <button type="button" onclick="document.getElementById('logo-file-input').click()" class="px-4 py-2 bg-secondary text-on-secondary rounded-lg font-label-sm text-label-sm hover:opacity-90 flex items-center gap-1 shadow-sm transition-all font-semibold">
                                    <span class="material-symbols-outlined text-sm">cloud_upload</span>
                                    Subir Imagen
                                </button>
                                <p class="text-[11px] text-on-surface-variant">Formatos permitidos: JPG, PNG, GIF. Máximo 2MB.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form actions -->
                <div class="flex justify-end gap-md pt-lg border-t border-outline-variant">
                    <button type="submit" id="btn-save-profile" class="px-6 py-2.5 bg-primary text-on-primary font-label-md text-label-md rounded-xl hover:opacity-95 shadow-sm transition-all font-semibold">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
        
    </main>
</div>

<!-- Toast Notification Container -->
<div id="toast" class="fixed bottom-5 right-5 bg-primary text-on-primary px-lg py-md rounded-xl shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-sm">
    <span class="material-symbols-outlined" id="toast-icon">check_circle</span>
    <span id="toast-message" class="font-label-md text-label-md"></span>
</div>

<script>
    function switchTab(tabId) {
        // Find all tabs and panels
        const tabBtns = document.querySelectorAll('.tab-btn');
        const panels = document.querySelectorAll('.tab-panel');
        
        // Hide all panels
        panels.forEach(p => p.classList.add('hidden'));
        
        // Show target panel
        const targetPanel = document.getElementById('panel-' + tabId);
        if (targetPanel) {
            targetPanel.classList.remove('hidden');
        }
        
        // Reset button states
        tabBtns.forEach(btn => {
            const currentTabId = btn.getAttribute('data-tab');
            if (currentTabId === tabId) {
                // Set active style
                btn.className = "tab-btn w-full bg-primary-container text-on-primary-container rounded-lg font-bold flex items-center gap-md px-md py-sm scale-95 transition-all duration-150 text-left";
            } else {
                // Set inactive style
                btn.className = "tab-btn w-full text-on-surface-variant flex items-center gap-md px-md py-sm hover:bg-surface-container-high rounded-lg transition-all text-left";
            }
        });
        
        // On mobile, close sidebar automatically
        if (window.innerWidth < 768) {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        }
    }

    function previewLogoImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logo-preview-image').src = e.target.result;
            };
            reader.readAsDataURL(file);
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

    function handleProfileSubmit(event) {
        event.preventDefault();
        
        const form = document.getElementById('company-profile-form');
        const btn = document.getElementById('btn-save-profile');
        const formData = new FormData(form);
        const token = form.querySelector('input[name="_token"]').value;
        
        btn.setAttribute('disabled', 'true');
        btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-[16px] leading-none align-middle mr-1">autorenew</span> Guardando...`;
        
        fetch('/company/profile', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            btn.removeAttribute('disabled');
            btn.innerHTML = 'Guardar Cambios';
            
            if (data.success) {
                showToast(data.message);
                
                // Update header company name
                const headerName = document.getElementById('header-company-name');
                if (headerName) {
                    headerName.textContent = data.company.name;
                }
                
                // Update header logo/initials
                const headerLogoContainer = document.querySelector('.w-10.h-10.rounded-full');
                if (headerLogoContainer && data.company.logo) {
                    headerLogoContainer.innerHTML = `<img id="header-logo" src="${data.company.logo}" alt="Logo" class="w-full h-full object-cover">`;
                } else if (headerLogoContainer) {
                    headerLogoContainer.innerHTML = `
                        <div id="header-initials" class="w-full h-full flex items-center justify-center bg-primary-container text-on-primary font-bold">
                            ${data.company.name.charAt(0).toUpperCase()}
                        </div>
                    `;
                }
                
                // Remove warning banner if it exists
                const warningBanner = document.getElementById('profile-warning-banner');
                if (warningBanner) {
                    warningBanner.remove();
                }
            } else {
                showToast(data.message || 'Error al guardar los cambios.', 'error');
            }
        })
        .catch(err => {
            btn.removeAttribute('disabled');
            btn.innerHTML = 'Guardar Cambios';
            showToast('Error de red al intentar guardar.', 'error');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Add click events to tab buttons
        const tabBtns = document.querySelectorAll('.tab-btn');
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                switchTab(tabId);
            });
        });
        
        // Mobile Sidebar Toggle
        const openBtn = document.getElementById('open-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        
        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
        
        if (openBtn) openBtn.addEventListener('click', toggleSidebar);
        if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
        if (backdrop) backdrop.addEventListener('click', toggleSidebar);
        
        // Initialize to show 'dashboard' panel first
        switchTab('dashboard');
    });
</script>
</body>
</html>
