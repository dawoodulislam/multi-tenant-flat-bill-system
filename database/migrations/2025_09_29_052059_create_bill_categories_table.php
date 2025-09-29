<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bill_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Electricity, Gas, Water, Utility Charges
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete(); // owner who created the category
            $table->timestamps();
            $table->unique(['owner_id','name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_categories');
    }
};
