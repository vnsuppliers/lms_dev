<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- tbl_assignedusers status values ---\n";
$au = DB::table('tbl_assignedusers')->select('status', DB::raw('count(*) as c'))->groupBy('status')->get();
foreach ($au as $r) {
    echo "status: " . json_encode($r->status) . " (count: {$r->c})\n";
}

echo "\n--- tbl_course_assessment_result pass_or_fail values ---\n";
$car = DB::table('tbl_course_assessment_result')
    ->select(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(results, '$.pass_or_fail')) as pf"), DB::raw('count(*) as c'))
    ->groupBy('pf')
    ->get();
foreach ($car as $r) {
    echo "pass_or_fail: " . json_encode($r->pf) . " (count: {$r->c})\n";
}

echo "\n--- tbl_exam_attempts exam_result values ---\n";
$tea = DB::table('tbl_exam_attempts')
    ->select('exam_result', DB::raw('count(*) as c'))
    ->groupBy('exam_result')
    ->get();
foreach ($tea as $r) {
    echo "exam_result: " . json_encode($r->exam_result) . " (count: {$r->c})\n";
}

echo "\n--- users active values ---\n";
$u = DB::table('users')->select('active', DB::raw('count(*) as c'))->groupBy('active')->get();
foreach ($u as $r) {
    echo "active: " . json_encode($r->active) . " (count: {$r->c})\n";
}
