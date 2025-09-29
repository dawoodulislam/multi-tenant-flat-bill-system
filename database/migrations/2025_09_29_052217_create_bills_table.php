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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('building_id')->constrained()->cascadeOnDelete();
            $table->foreignId('flat_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bill_category_id')->constrained();
            $table->date('month'); // store first day of month for simplicity
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['paid','unpaid'])->default('unpaid');
            $table->text('notes')->nullable();
            $table->decimal('due_previous', 10, 2)->default(0); // carried due
            $table->timestamps();

            $table->index(['owner_id','building_id','flat_id','status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
