<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'est_bloque' => $this->est_bloque,
            'prix_modifie' => $this->prix_modifie,
            'duree_min_modifiee' => $this->duree_min_midifiee,
            'post' => $this->when($this->whenLoaded('post'), function() {
                return $this->post;
            }),
        ];
    }
}
