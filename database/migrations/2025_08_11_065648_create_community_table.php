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
        Schema::create('community', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('description', 100);
            $table->unsignedBigInteger('coordinator_id');
            $table->unsignedBigInteger('subcoordinator_id');
            $table->timestamps();

            $table->foreign('coordinator_id')->references('id')->on('parishioner');
            $table->foreign('subcoordinator_id')->references('id')->on('parishioner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community');
    }
};
