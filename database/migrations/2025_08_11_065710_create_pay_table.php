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
        Schema::create('pay', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parishioner_id');
            $table->unsignedBigInteger('service_type_id');
            $table->Date('pay_date');
            $table->Integer('ammount');
            $table->string('note', 100)->nullable();
            $table->timestamps();

            $table->foreign('parishioner_id')->references('id')->on('parishioner');
            $table->foreign('service_type_id')->references('id')->on('service_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay');
    }
};
