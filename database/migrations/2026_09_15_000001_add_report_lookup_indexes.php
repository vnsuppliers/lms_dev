<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddReportLookupIndexes extends Migration
{
    private $indexes = [
        ['tbl_course_assessment_result', 'report_result_lookup', ['user_id', 'course_document_id', 'deleted_at', 'id']],
        ['tbl_course_documents_list', 'report_course_document_lookup', ['course_id', 'type']],
        ['tbl_exam_attempts', 'report_exam_assignment_lookup', ['assigned_id']],
    ];

    public function up()
    {
        foreach ($this->indexes as [$table, $name, $columns]) {
            // Live installations may already have an equivalent index under another name.
            $existing = collect(DB::select('SHOW INDEX FROM `'.$table.'`'))->groupBy('Key_name');
            $covered = $existing->contains(function ($parts) use ($columns) {
                $ordered = $parts->sortBy('Seq_in_index')->values();
                return $ordered->take(count($columns))->every(fn ($part) => $part->Sub_part === null)
                    && $ordered->pluck('Column_name')->take(count($columns))->all() === $columns;
            });
            if (!$covered && !$existing->has($name)) {
                Schema::table($table, function (Blueprint $blueprint) use ($name, $columns) {
                    $blueprint->index($columns, $name);
                });
            }
        }
    }

    public function down()
    {
        foreach ($this->indexes as [$table, $name]) {
            if (collect(DB::select('SHOW INDEX FROM `'.$table.'`'))->contains('Key_name', $name)) {
                Schema::table($table, function (Blueprint $blueprint) use ($name) {
                    $blueprint->dropIndex($name);
                });
            }
        }
    }
}
