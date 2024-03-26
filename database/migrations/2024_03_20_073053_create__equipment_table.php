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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('equipment_name');
            $table->string('category');
            $table->text('Description');
            $table->string('property_no');
            $table->string('serial_no');
            $table->string('value');
            $table->integer('quantity');
            $table->string('image')->nullable();
            $table->string('conditions');
            $table->string('remarks');
            $table->string('status');
            $table->string('date_acquired');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('tbl_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
