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
            Schema::create('creators', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');
                $table->timestamps();
            });

            Schema::create('creatables', function (Blueprint $table) {
                $table->foreignId('creator_id')->constrained();
                $table->unsignedBigInteger('creatable_id');
                $table->string('creatable_type');
                $table->string('role');
            });
        }

        /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::dropIfExists('creators');
        }
    };
