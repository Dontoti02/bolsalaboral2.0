<?php
// Actualizar CompanyDashboardController
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
    echo "WARN: CompanyDashboardController - no se encontró el patrón\n";
}

// Actualizar StudentController
$file = __DIR__ . '/app/Http/Controllers/StudentController.php';
$content = file_get_contents($file);

$old = "        return view('student.dashboard', compact(
            'totalApplications',
            'pendingApplications',
            'acceptedApplications',
            'recentApplications',
            'activeOffers',
            'cvsCount'
        ));";

$new = "        \$config = \\Illuminate\\Support\\Facades\\DB::table('system_configuration')->pluck('value', 'key')->all();

        return view('student.dashboard', compact(
            'totalApplications',
            'pendingApplications',
            'acceptedApplications',
            'recentApplications',
            'activeOffers',
            'cvsCount',
            'config'
        ));";

if (strpos($content, $old) !== false) {
    $content = str_replace($old, $new, $content);
    file_put_contents($file, $content);
    echo "OK: StudentController actualizado\n";
} else {
    echo "WARN: StudentController - no se encontró el patrón\n";
}

// Actualizar TeacherController
$file = __DIR__ . '/app/Http/Controllers/TeacherController.php';
$content = file_get_contents($file);

$old = "        return view('teacher.dashboard', compact('activeOffers', 'closedOffers'));";

$new = "        \$config = \\Illuminate\\Support\\Facades\\DB::table('system_configuration')->pluck('value', 'key')->all();

        return view('teacher.dashboard', compact('activeOffers', 'closedOffers', 'config'));";

if (strpos($content, $old) !== false) {
    $content = str_replace($old, $new, $content);
    file_put_contents($file, $content);
    echo "OK: TeacherController actualizado\n";
} else {
    echo "WARN: TeacherController - no se encontró el patrón\n";
}
