<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_reclam')->constrained('reclamations')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->dateTime('date')->useCurrent();
            $table->string('old_val')->nullable();
            $table->string('new_val')->nullable();
            $table->string('action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historiques');
    }
};