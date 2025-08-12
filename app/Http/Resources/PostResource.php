<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'titre'     => $this->titre,
            'slug'      => $this->slug,
            'type'      => $this->type,
            'ville'     => $this->ville,
            'pays'      => $this->pays,
            'prix_base' => $this->prix_base,
            'devise'    => $this->devise,
            'user' => $this->when($this->whenLoaded('user'), function() {
                return $this->user;
            }),

            
            'links' => [
                'self' => route('posts.show', $this->id),
                'update' => route('posts.update', $this->id),
                'delete' => route('posts.delete', $this->id),
            ],
        ];
    }
}
