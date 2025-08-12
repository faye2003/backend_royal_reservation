<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Calendrier;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationService
{
    public function create(array $data): Reservation
    {
        return DB::transaction(function () use ($data) {
            // 1) Vérifier indisponibilités (ex: dates bloquées)
            $existsBlocked = Calendrier::where('post_id', $data['post_id'])
                ->whereBetween('date', [$data['date_arrivee'], $data['date_depart']])
                ->where('est_bloque', true)
                ->exists();

            if ($existsBlocked) {
                throw ValidationException::withMessages([
                    'date' => 'Période indisponible pour cette post.',
                ]);
            }

            // 2) Créer la réservation
            $reservation = Reservation::create($data);

            // (Optionnel) 3) Notifs / paiement / logs…
            return $reservation;
        });
    }

    public function update(Reservation $reservation, array $data): Reservation
    {
        $reservation->update($data);
        return $reservation;
    }
}
