<?php
// Script para reemplazar el sidebar de teacher con el partial compartido
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

// Encontrar el inicio del body
$bodyStart = strpos($content, '<body class="bg-background text-on-background min-h-screen flex">');
if ($bodyStart === false) {
    echo "ERROR: No se encontró el body\n";
    exit(1);
}

// Construir el nuevo bloque a insertar
$newBlock = <<<'PHP'
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
PHP;

// Reemplazar el sidebar antiguo con el nuevo bloque
$before = substr($content, 0, $bodyStart + strlen('<body class="bg-background text-on-background min-h-screen flex">'));
$after = substr($content, $sidebarEnd);

// Eliminar el backdrop duplicado del archivo original (ya está en el partial)
$afterClean = preg_replace('/<!-- Backdrop for mobile -->\s*<div id="sidebar-backdrop"[^>]*><\/div>\s*/', '', $after, 1);

$newContent = $before . "\n\n    " . $newBlock . "\n\n    " . $afterClean;

file_put_contents($file, $newContent);
echo "OK: Sidebar de teacher reemplazado. Tamaño: " . strlen($newContent) . " bytes\n";
