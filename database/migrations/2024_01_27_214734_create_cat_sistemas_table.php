<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cat_sistemas', function (Blueprint $table) {
            $table->id();
$table->string('nombre');
$table->text('descripcion')->nullable();
$table->string('responsable');
$table->string('url_dominio')->nullable();
$table->string('ubicacion');
$table->string('procesos')->nullable();
$table->string('informacion');
$table->string('disponibilidad')->nullable();
$table->string('periodos')->nullable();
$table->string('codigo_fuente')->nullable();
$table->string('documentacion')->nullable();
$table->text('observaciones')->nullable();
$table->timestamps();//
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cat_sistemas');
    }
};
