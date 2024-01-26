<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sistemas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('responsable')->nullable();
            $table->string('url')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('procesos')->nullable();
            $table->string('informacion')->nullable();
            $table->string('disponibilidad')->nullable();
            $table->string('periodos')->nullable();
            $table->string('codigo_fuente')->nullable();
            $table->string('documentacion')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sistemas');
    }
};
