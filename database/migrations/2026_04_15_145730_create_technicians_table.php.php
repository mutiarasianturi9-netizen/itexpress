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
    Schema::create('technicians', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('age')->nullable();
    $table->string('phone');
    $table->text('address');
    $table->string('price_range')->nullable();
    $table->string('photo')->nullable();
    $table->boolean('status')->default(true);
    $table->foreignId('service_id')
          ->constrained()
          ->onDelete('cascade');

  
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};
