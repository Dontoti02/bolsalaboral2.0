<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Talentum - Portal del Estudiante</title>
    <style>
        :root {
            --primary-color: {{ $config['primary_color'] ?? '#002741' }};
            --primary-container-color: {{ $config['primary_color'] ?? '#0f3d5e' }};
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet">

    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05);
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex">

    @php
        $sidebarConfig = [
            'logo' => $config['logo'] ?? '/assets/logo.png',
            'brand' => 'Talentum',
            'subtitle' => 'Portal Estudiantil',
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
                        ['key' => 'applications', 'icon' => 'person_check', 'label' => 'Mis Postulaciones'],
                        ['key' => 'cvs', 'icon' => 'description', 'label' => 'Mis CVs'],
                    ],
                ],
            ],
        ];
    @endphp

    @include('partials.sidebar', ['sidebarConfig' => $sidebarConfig, 'config' => $config ?? []])

    

<!-- Main Content Wrapper -->
<div class="flex-1 md:ml-0 flex flex-col min-h-screen">
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
                        <p class="text-label-md font-semibold text-on-surface leading-none">{{ Auth::user()->person->names ?? 'Estudiante' }}</p>
                        <span class="text-[11px] text-on-surface-variant">Estudiante</span>
                    </div>
                    <div class="w-10 h-10 rounded-full overflow-hidden border border-outline-variant bg-primary-container text-on-primary flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->person->names ?? 'E', 0, 1) }}
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Dashboard Canvas -->
    <main class="flex-1 p-lg md:p-2xl space-y-xl max-w-container-max mx-auto w-full">
        
        <!-- ================= PANEL 1: OFERTAS LABORALES ================= -->
        <div id="panel-jobs" class="tab-panel space-y-xl">
            <!-- Welcome Section -->
            <div class="bg-primary-container text-on-primary rounded-xl p-xl shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary-fixed opacity-10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
                <div class="relative z-10">
                    <h1 class="font-headline-lg text-headline-lg mb-2">¡Hola, {{ explode(' ', Auth::user()->person->names ?? 'Estudiante')[0] }}! Bienvenido a tu panel de carrera.</h1>
                    <p class="text-primary-fixed-dim font-body-lg">Aquí tienes un resumen de tu actividad reciente y tus oportunidades.</p>
                </div>
                <div class="mt-lg flex flex-wrap gap-4">
                    <button onclick="switchTab('jobs')" class="bg-surface-container-lowest text-primary-container font-label-md px-6 py-2 rounded-lg hover:bg-surface-container-low transition-colors shadow-sm">Buscar empleos</button>
                    <button onclick="switchTab('cvs')" class="border border-primary-fixed-dim text-primary-fixed font-label-md px-6 py-2 rounded-lg hover:bg-on-primary-fixed-variant transition-colors">Subir CV</button>
                    <button onclick="switchTab('applications')" class="border border-primary-fixed-dim text-primary-fixed font-label-md px-6 py-2 rounded-lg hover:bg-on-primary-fixed-variant transition-colors">Mis postulaciones</button>
                </div>
            </div>

            <!-- Metrics Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-md">
                <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-label-md font-label-md text-on-surface-variant">Postulaciones realizadas</h3>
                        <div class="p-2 bg-primary-fixed rounded-lg text-on-primary-fixed">
                            <span class="material-symbols-outlined text-[20px]">send</span>
                        </div>
                    </div>
                    <p class="text-display-lg font-display-lg text-on-surface">{{ $totalApplications }}</p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-label-md font-label-md text-on-surface-variant">Pendientes</h3>
                        <div class="p-2 bg-tertiary-fixed rounded-lg text-on-tertiary-fixed">
                            <span class="material-symbols-outlined text-[20px]">pending_actions</span>
                        </div>
                    </div>
                    <p class="text-display-lg font-display-lg text-on-surface">{{ $pendingApplications }}</p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-label-md font-label-md text-on-surface-variant">Aprobadas</h3>
                        <div class="p-2 bg-secondary-fixed rounded-lg text-on-secondary-fixed">
                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        </div>
                    </div>
                    <p class="text-display-lg font-display-lg text-on-surface">{{ $acceptedApplications }}</p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-label-md font-label-md text-on-surface-variant">CVs cargados</h3>
                        <div class="p-2 bg-surface-variant rounded-lg text-on-surface-variant">
                            <span class="material-symbols-outlined text-[20px]">description</span>
                        </div>
                    </div>
                    <p class="text-display-lg font-display-lg text-on-surface">{{ $cvsCount }}</p>
                </div>
            </div>

            <!-- Main Content Area: Recommended Jobs & Recent Applications -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
                <!-- Recommended Jobs (2/3 width on large screens) -->
                <div class="lg:col-span-2 space-y-md">
                    <div class="flex justify-between items-center">
                        <h2 class="text-headline-sm font-headline-sm text-on-surface">Empleos Recomendados</h2>
                        <a class="text-label-sm font-label-sm text-primary-container hover:underline" href="#">Ver todos</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        @forelse($activeOffers as $offer)
                        <div onclick="openApplyModal('{{ $offer->id }}', '{{ addslashes($offer->title) }}', '{{ addslashes($offer->company_name) }}', '{{ addslashes($offer->description) }}')" class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm hover:border-primary transition-colors group cursor-pointer">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 bg-surface-container rounded-lg flex items-center justify-center border border-outline-variant">
                                    <span class="material-symbols-outlined text-on-surface-variant">corporate_fare</span>
                                </div>
                                <span class="bg-secondary-fixed/20 text-on-secondary-container px-2 py-1 rounded text-label-sm font-label-sm font-semibold">{{ $offer->category->name ?? 'General' }}</span>
                            </div>
                            <h3 class="text-headline-sm font-headline-sm mb-1 group-hover:text-primary-container transition-colors">{{ $offer->title }}</h3>
                            <p class="text-body-sm font-body-sm text-on-surface-variant mb-4">{{ $offer->company_name }} • {{ $offer->location_name }}</p>
                            <div class="flex gap-2 flex-wrap">
                                <span class="px-2 py-1 bg-surface-container-low text-on-surface-variant rounded-md text-label-sm">{{ $offer->workSchedule->name ?? 'Jornada completa' }}</span>
                                <span class="px-2 py-1 bg-surface-container-low text-on-surface-variant rounded-md text-label-sm">{{ $offer->contractType->name ?? 'Contrato' }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-2 text-center py-xl text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl text-outline mb-2 block">work_off</span>
                            <p class="font-semibold">No hay ofertas activas disponibles</p>
                            <p class="text-body-sm mt-1">Las nuevas ofertas aparecerán aquí.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                
                <!-- Recent Applications Table (1/3 width on large screens) -->
                <div class="lg:col-span-1 space-y-md">
                    <div class="flex justify-between items-center">
                        <h2 class="text-headline-sm font-headline-sm text-on-surface">Postulaciones Recientes</h2>
                    </div>
                    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <tbody>
                                @forelse($recentApplications->take(3) as $app)
                                @php
                                    $statusText = 'Pendiente';
                                    $statusClass = 'bg-tertiary-fixed text-on-tertiary-fixed-variant';
                                    if ($app->status === 'accepted') {
                                        $statusText = 'Aprobada';
                                        $statusClass = 'bg-secondary-fixed/50 text-on-secondary-container';
                                    } elseif ($app->status === 'rejected') {
                                        $statusText = 'Rechazada';
                                        $statusClass = 'bg-error-container text-on-error-container';
                                    }
                                @endphp
                                <tr class="border-b border-surface-container-high hover:bg-surface-container-low transition-colors">
                                    <td class="p-md">
                                        <p class="font-label-md text-on-surface">{{ $app->offer->title ?? 'Puesto' }}</p>
                                        <p class="text-body-sm text-on-surface-variant">{{ $app->offer->company->name ?? 'Empresa' }}</p>
                                    </td>
                                    <td class="p-md text-right">
                                        <span class="{{ $statusClass }} px-2 py-1 rounded text-label-sm font-label-sm font-semibold">{{ $statusText }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="p-md text-center text-on-surface-variant">No ha realizado ninguna postulación.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="p-sm bg-surface-container-lowest border-t border-outline-variant text-center">
                            <button onclick="switchTab('applications')" class="text-label-sm font-label-sm text-on-surface-variant hover:text-primary-container">Ver todas</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= PANEL 2: MIS POSTULACIONES ================= -->
        <div id="panel-applications" class="tab-panel space-y-xl hidden">
            <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden">
                <div class="p-lg border-b border-outline-variant">
                    <h2 class="text-headline-sm font-headline-sm text-on-surface">Historial de Postulaciones</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low text-on-surface-variant border-b border-outline-variant">
                                <th class="p-4 text-label-sm font-label-sm font-semibold">Puesto</th>
                                <th class="p-4 text-label-sm font-label-sm font-semibold">Empresa</th>
                                <th class="p-4 text-label-sm font-label-sm font-semibold">Fecha de Postulación</th>
                                <th class="p-4 text-label-sm font-label-sm font-semibold">Estado</th>
                                <th class="p-4 text-label-sm font-label-sm font-semibold text-right">Detalles</th>
                            </tr>
                        </thead>
                        <tbody class="text-body-md font-body-md">
                            @forelse($recentApplications as $app)
                            @php
                                $statusText = 'Pendiente';
                                $statusClass = 'bg-tertiary-fixed text-on-tertiary-fixed-variant';
                                if ($app->status === 'accepted') {
                                    $statusText = 'Aprobada';
                                    $statusClass = 'bg-secondary-fixed/50 text-on-secondary-container';
                                } elseif ($app->status === 'rejected') {
                                    $statusText = 'Rechazada';
                                    $statusClass = 'bg-error-container text-on-error-container';
                                }
                            @endphp
                            <tr class="border-b border-surface-container-high hover:bg-surface-container-low transition-colors">
                                <td class="p-4 font-semibold text-on-surface">{{ $app->offer->title ?? 'Puesto' }}</td>
                                <td class="p-4 text-on-surface-variant">{{ $app->offer->company->name ?? 'Empresa' }}</td>
                                <td class="p-4 text-on-surface-variant">{{ $app->created_at ? $app->created_at->format('d M Y') : '-' }}</td>
                                <td class="p-4">
                                    <span class="{{ $statusClass }} px-2.5 py-1 rounded-full text-label-sm font-label-sm font-semibold">{{ $statusText }}</span>
                                </td>
                                <td class="p-4 text-right">
                                    <button onclick="alert('Feedback del empleador: {{ $app->feedback ?: 'Ninguno' }}')" class="text-primary hover:underline text-label-sm font-label-sm font-semibold">Ver seguimiento</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-on-surface-variant">No ha realizado ninguna postulación aún.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= PANEL 3: MIS CVS ================= -->
        <div id="panel-cvs" class="tab-panel space-y-xl hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
                <!-- Upload Panel -->
                <div onclick="document.getElementById('cv-file-input').click()" class="lg:col-span-1 bg-surface-container-lowest border-2 border-dashed border-outline-variant rounded-2xl p-lg flex flex-col items-center justify-center text-center hover:border-primary transition-all cursor-pointer group">
                    <div class="w-12 h-12 rounded-full bg-primary-fixed text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">cloud_upload</span>
                    </div>
                    <h3 class="font-headline-sm text-[16px] font-bold text-on-surface mb-2">Sube un nuevo Currículum</h3>
                    <p class="text-body-sm text-on-surface-variant mb-4">Soporta formato PDF (Máx. 5MB).</p>
                    <button class="px-4 py-2 bg-primary text-on-primary rounded-xl text-label-md font-label-md font-semibold hover:bg-primary/95 transition-all">Seleccionar Archivo</button>
                    <form id="cv-upload-form" class="hidden">
                        @csrf
                        <input type="file" id="cv-file-input" name="cv" accept=".pdf" onchange="uploadCv(this)">
                    </form>
                </div>
                
                <!-- Document List -->
                <div class="lg:col-span-2 bg-surface-container-lowest rounded-2xl border border-outline-variant p-lg shadow-sm">
                    <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Mis Currículums Subidos</h3>
                    <div id="cv-list-container" class="space-y-md">
                        @forelse($cvs as $cv)
                        <div id="cv-item-{{ $cv->id }}" class="flex items-center justify-between p-md bg-surface-container-low rounded-xl border border-outline-variant">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-2xl">picture_as_pdf</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-on-surface text-body-sm leading-tight">{{ $cv->filename }}</h4>
                                    <p class="text-[11px] text-on-surface-variant mt-0.5">Subido el {{ $cv->uploaded_at }} • Versión {{ $cv->version }} @if($loop->first) • <span class="text-green-600 font-semibold">Principal</span> @endif</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('student.cv.download', $cv->id) }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl">download</span>
                                </a>
                                <button onclick="deleteCv({{ $cv->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-full transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </div>
                        </div>
                        @empty
                        <p id="no-cvs-placeholder" class="text-center py-8 text-on-surface-variant">No ha subido ningún currículum todavía.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
    </main>
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
                btn.className = "tab-btn w-full flex items-center gap-md px-md py-sm rounded-lg text-on-primary font-bold bg-primary-container text-left";
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
        
        // Initialize to show 'jobs' panel first as requested
        switchTab('jobs');
    });

    function showToast(message) {
        alert(message);
    }

    function uploadCv(input) {
        if (!input.files || input.files.length === 0) return;
        
        const formData = new FormData();
        formData.append('cv', input.files[0]);
        formData.append('_token', '{{ csrf_token() }}');
        
        showToast('Subiendo currículum...');
        
        fetch('{{ route("student.cv.upload") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast('¡Currículum subido con éxito!');
                location.reload();
            } else {
                showToast(data.message || 'Error al subir currículum.');
            }
        })
        .catch(err => {
            showToast('Error en la comunicación con el servidor.');
        });
    }
    
    function deleteCv(id) {
        if (!confirm('¿Está seguro de que desea eliminar este currículum?')) return;
        
        fetch('/student/cv/delete/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast('Currículum eliminado.');
                const el = document.getElementById('cv-item-' + id);
                if (el) el.remove();
                location.reload();
            } else {
                showToast(data.message || 'Error al eliminar.');
            }
        })
        .catch(err => {
            showToast('Error en el servidor.');
        });
    }

    function openApplyModal(id, title, company, desc) {
        document.getElementById('modal-offer-id').value = id;
        document.getElementById('modal-offer-title').textContent = title;
        document.getElementById('modal-offer-company').textContent = company;
        document.getElementById('modal-offer-desc').textContent = desc;
        document.getElementById('apply-modal').classList.remove('hidden');
        document.getElementById('apply-modal').classList.add('flex');
    }
    
    function closeApplyModal() {
        document.getElementById('apply-modal').classList.add('hidden');
        document.getElementById('apply-modal').classList.remove('flex');
    }
    
    function submitApplication() {
        const offerId = document.getElementById('modal-offer-id').value;
        const cvSelect = document.getElementById('modal-cv-select');
        if (!cvSelect || !cvSelect.value) {
            alert('Debe seleccionar un currículum. Si no tiene uno, súbalo en la sección Mis CVs.');
            return;
        }
        
        const payload = {
            cv_id: cvSelect.value,
            message: document.getElementById('modal-msg').value,
            _token: '{{ csrf_token() }}'
        };
        
        fetch('/student/apply/' + offerId, {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast('¡Postulación enviada exitosamente!');
                closeApplyModal();
                location.reload();
            } else {
                showToast(data.message || 'Error al postular.');
            }
        })
        .catch(err => {
            showToast('Error de comunicación con el servidor.');
        });
    }
</script>

<!-- Apply Modal -->
<div id="apply-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 p-4">
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant p-lg max-w-lg w-full space-y-md">
        <div class="flex justify-between items-start">
            <div>
                <h3 id="modal-offer-title" class="font-headline-md text-headline-md text-on-surface">Título de la Oferta</h3>
                <p id="modal-offer-company" class="text-body-sm text-on-surface-variant font-medium mt-1">Nombre de la Empresa</p>
            </div>
            <button onclick="closeApplyModal()" class="text-on-surface-variant hover:bg-surface-container-high p-1 rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="border-y border-outline-variant py-md space-y-md">
            <div>
                <h4 class="font-semibold text-body-sm text-on-surface">Descripción:</h4>
                <p id="modal-offer-desc" class="text-body-sm text-on-surface-variant mt-1 max-h-32 overflow-y-auto">Descripción completa...</p>
            </div>
            <form id="apply-form" class="space-y-md">
                @csrf
                <input type="hidden" id="modal-offer-id" name="offer_id">
                <div>
                    <label for="modal-cv-select" class="block font-semibold text-body-sm text-on-surface mb-1">Seleccionar Currículum:</label>
                    <select id="modal-cv-select" name="cv_id" class="w-full p-2 bg-surface border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                        @foreach($cvs as $cv)
                        <option value="{{ $cv->id }}">{{ $cv->filename }} (Versión {{ $cv->version }})</option>
                        @endforeach
                    </select>
                    @if($cvs->isEmpty())
                    <p class="text-xs text-red-600 mt-1">¡Debe subir un currículum primero en la pestaña "Mis CVs"!</p>
                    @endif
                </div>
                <div>
                    <label for="modal-msg" class="block font-semibold text-body-sm text-on-surface mb-1">Mensaje de presentación (Opcional):</label>
                    <textarea id="modal-msg" name="message" rows="3" class="w-full p-2 bg-surface border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none" placeholder="Escriba un breve mensaje para el reclutador..."></textarea>
                </div>
            </form>
        </div>
        <div class="flex justify-end gap-md">
            <button onclick="closeApplyModal()" class="px-5 py-2.5 border border-outline-variant text-on-surface-variant rounded-xl text-label-md font-label-md hover:bg-surface-container-high font-semibold transition-all">Cancelar</button>
            <button onclick="submitApplication()" class="px-5 py-2.5 bg-primary text-on-primary rounded-xl text-label-md font-label-md hover:opacity-95 font-semibold transition-all">Enviar Postulación</button>
        </div>
    </div>
</div>
</body>
</html>
