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

        Schema::create('reservations', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts'); // Référence à l'post
            $table->foreignId('user_id')->constrained('users'); // Référence à l'invité (utilisateur)
            $table->date('date_arrivee'); // Date d'arrivée
            $table->date('date_depart'); // Date de départ
            $table->unsignedSmallInteger('nombre_nuits'); // Nombre de nuits
            $table->unsignedSmallInteger('nombre_invites'); // Nombre d'invités
            $table->enum('statut', [
                'en_attente',   // En attente
                'approuve',     // Approuvé
                'paye',         // Payé
                'annule',       // Annulé
                'termine',      // Terminé
                'rembourse'     // Remboursé
            ])->default('en_attente'); // Statut par défaut
            $table->integer('montant_total'); // Montant total (en centimes)
            $table->string('devise', 3)->default('XOF'); // Devise
            $table->string('id_paiement_intention')->nullable(); // ID de l'intention de paiement
            $table->timestamps(); // Dates de création et mise à jour
            $table->unique(['post_id', 'date_arrivee', 'date_depart'], 'bk_unique_interval'); // Unicité sur la période
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
