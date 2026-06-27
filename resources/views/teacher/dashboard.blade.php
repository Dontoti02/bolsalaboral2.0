<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Talentum - Portal Docente</title>
    <style>
        :root {
            --primary-color: {{ $config['primary_color'] ?? '#002741' }};
            --primary-container-color: {{ $config['primary_color'] ?? '#0f3d5e' }};
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet">

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
