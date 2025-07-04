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
        //
        Schema::create("presentateurs", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seminaire_id')->unsigned();
            $table->unsignedBigInteger('presentateur_id')->unsigned();
            $table->foreign('presentateur_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->foreign('seminaire_id')
                    ->references('id')
                    ->on('seminaires')
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
        //
    }
};
