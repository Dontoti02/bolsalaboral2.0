<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Talentum - Portal Docente</title>
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
                        "primary-container": "{{ $config['primary_color'] ?? '#002741' }}",
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
                        "primary": "{{ $config['primary_color'] ?? '#002741' }}",
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
            'subtitle' => 'Portal Docente',
            'active' => '',
            'home_tab' => 'jobs',
            'show_publish' => false,
            'show_help' => true,
            'help_label' => 'Centro de Ayuda',
            'items' => [
                [
                    'label' => '',
                    'items' => [
                        ['key' => 'jobs', 'icon' => 'work', 'label' => 'Ofertas Laborales'],
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
                    <input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Buscar empleo, palabras clave..." type="text">
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
                        <p class="text-label-md font-semibold text-on-surface leading-none">{{ Auth::user()->person->names ?? 'Docente' }}</p>
                        <span class="text-[11px] text-on-surface-variant">Portal Docente</span>
                    </div>
                    <div class="w-10 h-10 rounded-full overflow-hidden border border-outline-variant bg-primary-container text-on-primary flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->person->names ?? 'D', 0, 1) }}
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Dashboard Canvas -->
    <main class="flex-1 p-lg md:p-2xl w-full max-w-container-max mx-auto space-y-xl">
        <!-- Page Header -->
        <div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Ofertas Laborales</h1>
            <p class="font-body-md text-body-md text-on-surface-variant">Monitorea y comparte las convocatorias vigentes con tus estudiantes.</p>
        </div>
        
        <!-- Job Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
            @forelse($activeOffers as $offer)
            <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm hover:border-primary transition-colors flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 bg-surface-container rounded-lg flex items-center justify-center border border-outline-variant text-primary font-bold text-headline-sm">{{ $offer->initial }}</div>
                        <span class="bg-secondary-fixed/20 text-on-secondary-container px-2 py-0.5 rounded text-label-sm font-label-sm font-semibold">{{ $offer->state_name }}</span>
                    </div>
                    <h3 class="font-headline-sm text-[18px] text-on-surface mb-1 leading-tight">{{ $offer->title }}</h3>
                    <p class="text-body-sm text-on-surface-variant mb-4">{{ $offer->company_name }} • {{ $offer->location_name }} ({{ $offer->schedule_name }})</p>
                    <p class="text-body-sm text-on-surface-variant line-clamp-3 mb-4">{{ $offer->description }}</p>
                </div>
                <div class="border-t border-outline-variant pt-4 flex items-center justify-between mt-auto">
                    <span class="text-[11px] text-outline">Publicado el {{ $offer->publication_formatted }}</span>
                    <button onclick="shareJob('{{ addslashes($offer->title) }}')" class="text-primary hover:bg-primary-fixed font-label-md text-label-md px-4 py-2 rounded-lg border border-outline-variant flex items-center gap-1 font-semibold transition-all">
                        <span class="material-symbols-outlined text-[18px]">share</span>
                        Compartir
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-xl text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl text-outline mb-2 block">work_off</span>
                <p class="font-semibold">No hay ofertas activas disponibles</p>
                <p class="text-body-sm mt-1">Las nuevas ofertas aparecerán aquí.</p>
            </div>
            @endforelse

            @foreach($closedOffers as $offer)
            <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm hover:border-primary transition-colors flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 bg-surface-container rounded-lg flex items-center justify-center border border-outline-variant text-primary font-bold text-headline-sm">{{ $offer->initial }}</div>
                        <span class="bg-surface-container text-on-surface-variant px-2 py-0.5 rounded text-label-sm font-label-sm font-semibold">{{ $offer->state_name }}</span>
                    </div>
                    <h3 class="font-headline-sm text-[18px] text-on-surface mb-1 leading-tight">{{ $offer->title }}</h3>
                    <p class="text-body-sm text-on-surface-variant mb-4">{{ $offer->company_name }} • {{ $offer->location_name }}</p>
                    <p class="text-body-sm text-on-surface-variant line-clamp-3 mb-4">Oferta finalizada. No se aceptan más postulaciones.</p>
                </div>
                <div class="border-t border-outline-variant pt-4 flex items-center justify-between mt-auto">
                    <span class="text-[11px] text-outline">Publicado el {{ $offer->publication_formatted }}</span>
                    <button onclick="shareJob('{{ addslashes($offer->title) }}')" class="text-primary hover:bg-primary-fixed font-label-md text-label-md px-4 py-2 rounded-lg border border-outline-variant flex items-center gap-1 font-semibold transition-all">
                        <span class="material-symbols-outlined text-[18px]">share</span>
                        Compartir
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>

<!-- Simple Toast Notification for Sharing -->
<div id="toast" class="fixed bottom-5 right-5 bg-primary text-on-primary px-lg py-md rounded-xl shadow-lg transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center gap-sm">
    <span class="material-symbols-outlined">check_circle</span>
    <span id="toast-message" class="text-body-sm font-semibold">¡Enlace copiado al portapapeles!</span>
</div>

<script>
    function shareJob(jobTitle) {
        // Mock copy link to clipboard
        const dummyUrl = window.location.origin + '/oferta/' + jobTitle.toLowerCase().replace(/ /g, '-');
        
        navigator.clipboard.writeText(dummyUrl).then(() => {
            showToast('¡Enlace de "' + jobTitle + '" copiado al portapapeles!');
        }).catch(err => {
            // Fallback
            showToast('¡Enlace copiado al portapapeles!');
        });
    }

    function showToast(message) {
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-message');
        toastMsg.textContent = message;
        
        toast.classList.remove('translate-y-20', 'opacity-0');
        
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
</body>
</html>
