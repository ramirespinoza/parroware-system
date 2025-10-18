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
        Schema::create('assigned_sacrament', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('priest_id');
            $table->unsignedBigInteger('sacrament_type_id');
            $table->unsignedBigInteger('parishioner_id');
            $table->date('scheduled_date');
            $table->enum('assigned_sacrament_status', ['Pending', 'Done', 'Cancelled']);
            $table->timestamps();

            $table->foreign('priest_id')->references('id')->on('priest');
            $table->foreign('sacrament_type_id')->references('id')->on('sacrament_type');
            $table->foreign('parishioner_id')->references('id')->on('parishioner');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_sacrament');
    }
};
