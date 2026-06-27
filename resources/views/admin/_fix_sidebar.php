<?php
// Script para reemplazar el sidebar del admin con el partial compartido
$file = __DIR__ . '/dashboard.blade.php';
$content = file_get_contents($file);

// Encontrar el inicio del sidebar
$sidebarStart = strpos($content, '<!-- SideNavBar -->');
if ($sidebarStart === false) {
    echo "ERROR: No se encontró el sidebar\n";
    exit(1);
}

// Encontrar el final del sidebar (</aside> después del sidebar)
$sidebarEnd = strpos($content, '</aside>', $sidebarStart);
if ($sidebarEnd === false) {
    echo "ERROR: No se encontró el cierre del sidebar\n";
    exit(1);
}
$sidebarEnd += strlen('</aside>');

// Encontrar el inicio del body para insertar la configuración del sidebar antes del sidebar
$bodyStart = strpos($content, '<body class="bg-background text-on-background font-body-md min-h-screen flex">');
if ($bodyStart === false) {
    echo "ERROR: No se encontró el body\n";
    exit(1);
}

// Encontrar el @php existente después del body
$phpStart = strpos($content, '@php', $bodyStart);
$phpEnd = strpos($content, '@endphp', $phpStart);
if ($phpStart === false || $phpEnd === false) {
    echo "ERROR: No se encontró el bloque @php\n";
    exit(1);
}
$phpEnd += strlen('@endphp');

// Construir el nuevo bloque @php con la configuración del sidebar
$newPhp = <<<'PHP'
@php
        $adminUser = auth()->user();
        $adminPerson = $adminUser?->person;
        $adminName = $adminPerson?->names ?: 'Administrador';
        $adminEmail = $adminUser?->email ?: '';
        $adminNameParts = preg_split('/\s+/', trim($adminName));
        $adminInitials = collect($adminNameParts)->filter()->take(2)->map(fn($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('');
        $adminAvatarUrl = $adminUser?->avatar ? \Illuminate\Support\Facades\Storage::url($adminUser->avatar) : null;

        $sidebarConfig = [
            'logo' => $config['logo'] ?? '/assets/logo.png',
            'brand' => 'Talentum',
            'subtitle' => 'Panel de Administración',
            'active' => '',
            'home_tab' => 'dashboard',
            'show_publish' => true,
            'publish_tab' => 'offers',
            'publish_label' => 'Publicar Oferta',
            'show_help' => true,
            'help_label' => 'Soporte',
            'items' => [
                [
                    'label' => 'Configuración',
                    'items' => [
                        ['key' => 'users', 'icon' => 'group', 'label' => 'Usuarios'],
                    ],
                ],
                [
                    'label' => 'Preferencias',
                    'items' => [
                        ['key' => 'settings', 'icon' => 'tune', 'label' => 'Ajustes'],
                    ],
                ],
                [
                    'label' => 'Bolsa Laboral',
                    'items' => [
                        ['key' => 'offers', 'icon' => 'list_alt', 'label' => 'Ofertas'],
                        ['key' => 'companies-manage', 'icon' => 'corporate_fare', 'label' => 'Empresas · Gestionar'],
                        ['key' => 'companies-register', 'icon' => 'add_business', 'label' => 'Empresas · Registrar'],
                        ['key' => 'applications', 'icon' => 'person_search', 'label' => 'Postulaciones'],
                    ],
                ],
                [
                    'label' => '',
                    'items' => [
                        ['key' => 'maintainers', 'icon' => 'settings', 'label' => 'Mantenedores'],
                    ],
                ],
            ],
        ];
    @endphp

    @include('partials.sidebar', ['sidebarConfig' => $sidebarConfig, 'config' => $config ?? []])
PHP;

// Reemplazar el bloque @php existente con el nuevo
$before = substr($content, 0, $phpStart);
$after = substr($content, $phpEnd);

// Eliminar el sidebar antiguo (entre sidebarStart y sidebarEnd)
$afterWithoutSidebar = substr($after, strpos($after, '<!-- Backdrop for mobile sidebar -->'));

$newContent = $before . $newPhp . "\n\n    " . $afterWithoutSidebar;

file_put_contents($file, $newContent);
echo "OK: Sidebar del admin reemplazado. Tamaño: " . strlen($newContent) . " bytes\n";
