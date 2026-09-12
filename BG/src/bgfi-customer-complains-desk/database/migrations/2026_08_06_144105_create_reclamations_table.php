<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->date('date_creation');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->enum('canal', ['Agence', 'Téléphone', 'Email', 'Application mobile']);
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->text('description');
            $table->foreignId('priorite_id')->constrained('priorites')->onDelete('cascade');
            $table->enum('statut', ['Nouvelle', 'Affectée', 'En cours de traitement', 'En attente client', 'Résolue', 'Clôturée'])->default('Nouvelle');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->date('date_limite')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reclamations');
    }
};