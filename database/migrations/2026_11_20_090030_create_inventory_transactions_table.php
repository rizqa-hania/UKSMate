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
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->bigIncrements('transaction_id');
            $table->unsignedBigInteger('batch_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('visit_id')->nullable();
            $table->enum('transaction_type', [ 'in', 'out', 'adjustment_in', 'adjustment_out' ]);
            $table->unsignedInteger('quantity');
            $table->dateTime('transaction_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('batch_id')->references('batch_id')->on('inventory_batches');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('visit_id')->references('visit_id')->on('visits');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
