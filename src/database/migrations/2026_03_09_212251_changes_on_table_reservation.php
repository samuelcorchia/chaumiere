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
    Schema::table('reservations', function (Blueprint $table) {
        // 1. Suppression de table_id si elle existe encore
        if (Schema::hasColumn('reservations', 'table_id')) {
            $table->dropColumn('table_id'); 
        }

        // 2. Gestion de user_id
        if (Schema::hasColumn('reservations', 'user_id')) {
            // ON SUPPRIME L'INDEX (car ce n'est pas une Foreign Key selon ton SQL)
            $table->dropIndex('reservations_user_id_foreign');
            $table->dropColumn('user_id'); 
        }

        // 3. Ajout des nouveaux champs (on les ajoute proprement)
        // On utilise after('id') pour garder une structure logique
        $table->bigInteger('user_id')->unsigned()->nullable()->after('id');
        $table->string('tables_id')->nullable()->after('user_id');
        $table->string('phone')->nullable();
        $table->string('mail')->nullable();
        $table->text('remarque')->nullable();
        $table->string('dateresa')->nullable();
        $table->string('heure')->nullable();
        $table->string('nom')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }
};
