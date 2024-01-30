<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('url_dominio');
            $table->string('url_proyecto');
            $table->string('url_codigo_fuente');
            $table->string('responsable');
            $table->string('area');
            $table->string('informacion_contenida');
            $table->string('disponibilidad');
            $table->date('periodo_inicio');
            $table->date('periodo_final');
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
