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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_id');
            $table->string('release_by');
            $table->string('borrowed_by');
            $table->datetime('date_borrowed');
            $table->datetime('date_returned')->nullable();
            $table->string('office_id');
            $table->string('upload_file')->nullable();
            $table->datetime('returned_date')->nullable();
            $table->string('returned_by')->nullable();
            $table->string('received_by')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
