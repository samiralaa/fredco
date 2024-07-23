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
        Schema::create('serves_items', function (Blueprint $table) {
            $table->id();
            $table->string('itim');
            $table->unsignedBigInteger('serves_id');
            $table->foreign('serves_id')->references('id')->on('serves');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serves_items');
    }
};
