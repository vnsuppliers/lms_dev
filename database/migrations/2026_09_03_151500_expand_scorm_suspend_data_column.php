<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ExpandScormSuspendDataColumn extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE `tbl_scorm_progress` MODIFY `suspend_data` LONGTEXT NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE `tbl_scorm_progress` MODIFY `suspend_data` TEXT NULL');
    }
}
