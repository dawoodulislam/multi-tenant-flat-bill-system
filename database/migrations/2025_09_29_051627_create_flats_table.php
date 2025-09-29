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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained()->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete(); // house owner id for isolation
            $table->string('flat_number');
            $table->string('flat_owner_name')->nullable();
            $table->string('flat_owner_contact')->nullable();
            $table->string('flat_owner_email')->nullable();
            $table->timestamps();

            $table->unique(['building_id','flat_number']);
            $table->index(['owner_id','building_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
};
