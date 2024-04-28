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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('destination', 100);
            $table->date('start_at');
            $table->date('end_at');
            $table->text('description')->nullable();
            $table->decimal('price', 7, 2);
            $table->string('accommodation', 100);
            $table->unsignedBigInteger('transport_id')->nullable();
            $table->foreign('transport_id')->references('id')->on('transports')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
