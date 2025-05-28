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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('capacity');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('status')->default('active');
            $table->string('image')->nullable();
            
            // Foreign key dengan nullable dan pastikan tipe data sama
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('organizer_id');
            
            $table->timestamps();
            
            // Tambahkan foreign key constraints setelah kolom dibuat
            // Pastikan tabel event_categories sudah ada
            if (Schema::hasTable('event_categories')) {
                $table->foreign('category_id')->references('id')->on('event_categories')->onDelete('set null');
            }
            
            // Pastikan tabel users sudah ada untuk organizer
            if (Schema::hasTable('users')) {
                $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};