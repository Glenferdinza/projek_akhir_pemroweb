<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('registration_status', ['pending', 'confirmed', 'cancelled', 'waitlist'])->default('pending');
            $table->dateTime('registered_at')->default(now());
            $table->json('additional_data')->nullable(); // For storing extra form data
            $table->text('notes')->nullable();
            $table->boolean('payment_status')->default(false);
            $table->enum('payment_method', ['cash', 'transfer', 'credit_card', 'e_wallet'])->nullable();
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->timestamps();
            
            // Ensure unique registration per user per event
            $table->unique(['event_id', 'user_id']);
            $table->index(['user_id']);
            $table->index(['event_id', 'registration_status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
};