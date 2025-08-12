<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'date_arrivee'    => $this->date_arrivee,
            'date_depart'     => $this->date_depart,
            'nombre_nuits'    => $this->nombre_nuits,
            'nombre_invites'  => $this->nombre_invites,
            'statut'          => $this->statut,
            'montant_total'   => $this->montant_total,
            'devise'          => $this->devise,
            'created_at'      => $this->created_at?->toIso8601String(),
            'updated_at'      => $this->updated_at?->toIso8601String(),
            'post' => $this->when($this->whenLoaded('post'), function() {
                return $this->post;
            }),
            'user' => $this->when($this->whenLoaded('user'), function() {
                return $this->user;
            }),
        ];
    }
}
