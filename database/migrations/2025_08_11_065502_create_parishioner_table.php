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
        Schema::create('parishioner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dpi');
            $table->string('name', 45);
            $table->string('last_name', 45);
            $table->date('birthday');
            $table->string('address', 100);
            $table->unsignedInteger('phone_number');
            $table->string('email', 45);
            $table->unsignedBigInteger('community_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parishioner');
    }
};
