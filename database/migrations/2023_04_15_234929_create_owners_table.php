<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('general_record', 10)->unique();
            $table->string('registration_physical_person', 14)->unique();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female', 'uninformed'])->default('uninformed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
