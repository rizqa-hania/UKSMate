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
        Schema::create('inventory_batches', function (Blueprint $table) {
            $table->bigIncrements('batch_id');
            $table->unsignedBigInteger('item_id');
            $table->string('batch_number')->nullable();
            $table->date('expiration_date')->nullable();
            $table->unsignedInteger('quantity_available')->default(0);
            $table->date('received_date');
            $table->timestamps();

            $table->foreign('item_id')->references('item_id')->on('inventory_items');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_batches');
    }

};
