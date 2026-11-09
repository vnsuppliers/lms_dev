<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$svc = app(App\Services\ReportService::class);

echo "=== COURSES DATA SOURCE CHECK ===" . PHP_EOL;
$builtCourses = $svc->buildQuery('courses', ['data_source' => 'courses']);
echo "Courses SQL: " . $builtCourses['query']->toSql() . PHP_EOL;
echo "Total courses count in query: " . $builtCourses['query']->count() . PHP_EOL;

$sampleCourses = $builtCourses['query']->take(3)->get();
print_r($sampleCourses);
