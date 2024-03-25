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
        Schema::create('comentario_adjuntos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('comentario_id');
            $table->unsignedBigInteger('adjuntos_id');
            $table->foreign('comentario_id')->references('id')->on('comentarios');
            $table->foreign('adjuntos_id')->references('id')->on('adjuntos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario_adjuntos');
    }
};
