<?php
$file = __DIR__ . '/app/Http/Controllers/CompanyDashboardController.php';
$content = file_get_contents($file);

$old = "        return view('company.dashboard', compact(
            'company',
            'offersCount',
            'activeOffersCount',
            'applicantsCount',
            'pendingApplicantsCount',
            'recentOffers',
            'recentApplicants'
        ));";

$new = "        \$config = \\Illuminate\\Support\\Facades\\DB::table('system_configuration')->pluck('value', 'key')->all();

        return view('company.dashboard', compact(
            'company',
            'offersCount',
            'activeOffersCount',
            'applicantsCount',
            'pendingApplicantsCount',
            'recentOffers',
            'recentApplicants',
            'config'
        ));";

if (strpos($content, $old) !== false) {
    $content = str_replace($old, $new, $content);
    file_put_contents($file, $content);
    echo "OK: CompanyDashboardController actualizado\n";
} else {
    echo "WARN: no se encontró el patrón\n";
    // Debug: buscar líneas similares
    $lines = explode("\n", $content);
    foreach ($lines as $i => $line) {
        if (strpos($line, "return view('company.dashboard'") !== false) {
            echo "Línea $i: " . substr($line, 0, 80) . "\n";
        }
    }
}
