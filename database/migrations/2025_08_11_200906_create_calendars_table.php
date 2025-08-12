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
       Schema::create('calendars', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->foreignId('post_id') // Référence à l'post
                ->constrained('posts') // Lien avec la table des posts
                ->cascadeOnDelete(); // Suppression en cascade
            $table->date('date'); // Date du calendrier
            $table->boolean('est_bloque')->default(false); // Indique si la date est bloquée
            $table->integer('prix_modifie')->nullable(); // Prix personnalisé (en centimes)
            $table->unsignedTinyInteger('duree_min_modifiee')->nullable(); // Durée minimale de séjour modifiée
            $table->unique(['post_id', 'date']); // Unicité par post et date
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
