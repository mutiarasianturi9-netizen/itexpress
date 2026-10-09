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
        Schema::create('reviews', function (Blueprint $table) {

            $table->id();

            /*
            |----------------------------------------------------------
            | ORDER
            |----------------------------------------------------------
            */

            $table->foreignId('order_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');

            /*
            |----------------------------------------------------------
            | KONTAK / PESAN
            |----------------------------------------------------------
            */

            $table->string('name')->nullable();

            $table->string('contact')->nullable();

            $table->string('topic')->nullable();

            /*
            |----------------------------------------------------------
            | REVIEW
            |----------------------------------------------------------
            */

            $table->integer('rating')->nullable();

            $table->text('comment')->nullable();

            /*
            |----------------------------------------------------------
            | TIMESTAMP
            |----------------------------------------------------------
            */

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};