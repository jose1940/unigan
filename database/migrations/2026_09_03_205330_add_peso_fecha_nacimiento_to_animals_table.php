<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('animals', function (Blueprint $table) {
            $table->decimal('peso', 8, 2)->nullable()->after('especie');
            $table->date('fecha_nacimiento')->nullable()->after('peso');
        });
    }

    public function down(): void {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn(['peso', 'fecha_nacimiento']);
        });
    }
};