<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::table('concerts', function (Blueprint $table) {
            $table->string('type_event')->default(true)->after('link_event');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('concerts', function (Blueprint $table) {
            $table->dropColumn('type_event');
        });
    }
};
