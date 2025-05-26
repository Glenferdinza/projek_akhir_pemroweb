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
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('user_id');
            $table->string('registration_status')->default('pending'); // pending, confirmed, cancelled
            $table->datetime('registered_at');
            $table->json('additional_data')->nullable(); // For storing extra registration info
            $table->text('notes')->nullable();
            $table->boolean('payment_status')->default(false);
            $table->string('payment_method')->nullable();
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->timestamps();
            
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['event_id', 'user_id']);
            $table->index('registration_status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
};