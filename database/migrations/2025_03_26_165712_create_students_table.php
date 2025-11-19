<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address');
            $table->date('birth_date');
            $table->string('phone_number');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade'); // Un estudiant pertany a un usuari
            $table->foreignId('cicle_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete(); // Un estudiant pertany a un cicle (opcional, per això el nulleable)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
