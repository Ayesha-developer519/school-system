<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedInteger('roll_number');
            $table->string('invite_code')->unique()->nullable();
            $table->timestamp('invite_code_used_at')->nullable();
            $table->string('father_name');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->date('admission_date');
            $table->timestamps();

            $table->unique(['class_id', 'roll_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};