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
        Schema::create('listens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('listenables', function (Blueprint $table) {
            $table->foreignId('listen_id')->constrained();
            $table->unsignedBigInteger('listenable_id');
            $table->string('listenable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listens');
    }
};
