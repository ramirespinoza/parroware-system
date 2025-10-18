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
        Schema::create('certificate', function (Blueprint $table) {
            $table->id();
            $table->text('certificate');
            $table->date('isue_date');
            $table->unsignedBigInteger('assigned_sacrament_id');
            $table->timestamps();

            $table->foreign('assigned_sacrament_id')->references('id')->on('assigned_sacrament');
        });

        Schema::table('parishioner', function (Blueprint $table) {

            $table->foreign('community_id')->references('id')->on('community');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate');
    }
};
