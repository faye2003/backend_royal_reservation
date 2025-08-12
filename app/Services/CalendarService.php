<?php

namespace App\Services;

use App\Models\Calendrier;

class CalendrierService
{
    public function upsert(array $data): Calendrier
    {
        return Calendrier::updateOrCreate(
            ['post_id' => $data['post_id'], 'date' => $data['date']],
            [
                'est_bloque'         => $data['est_bloque'] ?? false,
                'prix_modifie'       => $data['prix_modifie'] ?? null,
                'duree_min_modifiee' => $data['duree_min_modifiee'] ?? null,
            ]
        );
    }
}
