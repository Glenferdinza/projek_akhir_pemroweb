<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom belum ada sebelum menambahkannya
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'institution')) {
                $table->string('institution')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'student_id')) {
                $table->string('student_id')->nullable()->after('institution');
            }
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable()->after('student_id');
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('profile_image');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('bio');
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('is_active');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek apakah kolom ada sebelum menghapusnya
            $columnsToCheck = ['phone', 'institution', 'student_id', 'profile_image', 'bio', 'is_active', 'last_login_at'];
            $columnsToRemove = [];
            
            foreach ($columnsToCheck as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $columnsToRemove[] = $column;
                }
            }
            
            if (!empty($columnsToRemove)) {
                $table->dropColumn($columnsToRemove);
            }
        });
    }
};