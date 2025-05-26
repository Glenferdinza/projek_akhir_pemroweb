<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('category')->default('seminar'); // seminar, competition, workshop
            $table->string('status')->default('active'); // active, inactive, completed
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('location')->nullable();
            $table->string('organizer');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->integer('max_participants')->nullable();
            $table->integer('current_participants')->default(0);
            $table->decimal('registration_fee', 10, 2)->default(0);
            $table->string('image_url')->nullable();
            $table->json('requirements')->nullable(); // JSON array of requirements
            $table->text('additional_info')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['category', 'status']);
            $table->index('start_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};