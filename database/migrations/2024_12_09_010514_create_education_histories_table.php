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
        Schema::create('education_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->text('academic_degree'); // Relación con el título académico
            $table->text('institution'); // Relación con la institución educativa
            $table->text('location'); // Relación con la ubicación
            $table->timestamp('start_date')->nullable(); // Fecha de inicio
            $table->timestamp('end_date')->nullable(); // Fecha de fin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_histories');
    }
};
