<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_certificates', function (Blueprint $table) {
            $table->string('signer_name')->nullable()->after('signature_drawn');
            $table->string('signer_profession')->nullable()->after('signer_name');
        });
    }

    public function down(): void
    {
        Schema::table('tbl_certificates', function (Blueprint $table) {
            $table->dropColumn(['signer_name', 'signer_profession']);
        });
    }
};
