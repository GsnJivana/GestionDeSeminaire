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
        Schema::disableForeignKeyConstraints();
        Schema::create('seminaires', function (Blueprint $table) {
            $table->id();
            $table->string('theme');
            $table->string('title');
            $table->string('slug');
            $table->string('resume_de_la_presentation_path', 2048)->nullable();
            $table->text('description')->nullable();
            $table->date('date_de_presentation');
            $table->enum('statut', ['non_valider', 'valider' ])->default('non_valider');
            $table->unsignedBigInteger('presentateur_id');
            $table->foreign('presentateur_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminaires');
    }
};
