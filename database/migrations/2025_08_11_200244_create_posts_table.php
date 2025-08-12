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
       Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->foreignId('user_id')->constrained('users'); // Référence à l'hôte (utilisateur)
            $table->string('titre'); // Titre de l'post
            $table->string('slug')->unique(); // URL unique
            $table->enum('type', [
                'chambre',  // Chambre
                'entier'    // Logement entier
            ]);
            $table->text('description'); // Description de l'post
            $table->string('ville'); // Ville
            $table->string('pays', 2); // Code pays (ISO 3166-1 alpha-2)
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude
            $table->integer('prix_base'); // Prix de base (en centimes)
            $table->string('devise', 3)->default('XOF'); // Devise
            $table->integer('frais_menage')->default(0); // Frais de ménage (en centimes)
            $table->unsignedTinyInteger('pourcentage_frais_service')->default(10); // Pourcentage frais de service
            $table->unsignedTinyInteger('nb_min_nuits')->default(1); // Nombre minimum de nuits
            $table->unsignedTinyInteger('nb_max_nuits')->default(30); // Nombre maximum de nuits
            $table->boolean('reservation_instantanee')->default(false); // Réservation instantanée
            $table->enum('statut', [
                'brouillon',  // Brouillon
                'en_revision',// En révision
                'actif',      // Actif
                'bloque'      // Bloqué
            ])->default('brouillon'); // Statut par défaut
            $table->timestamps(); // Dates de création et mise à jour
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
