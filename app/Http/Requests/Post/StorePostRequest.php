<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'user_id'                     => ['required','exists:users,id'],
            'titre'                       => ['required','string','max:255'],
            'slug'                        => ['nullable','string','max:255','unique:posts,slug'],
            'type'                        => ['required','in:chambre,entier'],
            'description'                 => ['required','string'],
            'ville'                       => ['required','string','max:120'],
            'pays'                        => ['required','string','size:2'],
            'latitude'                    => ['nullable','numeric','between:-90,90'],
            'longitude'                   => ['nullable','numeric','between:-180,180'],
            'prix_base'                   => ['required','integer','min:0'],
            'devise'                      => ['required','string','size:3'],
            'frais_menage'                => ['nullable','integer','min:0'],
            'pourcentage_frais_service'   => ['nullable','integer','min:0','max:100'],
            'nb_min_nuits'                => ['nullable','integer','min:1'],
            'nb_max_nuits'                => ['nullable','integer','min:1','gte:nb_min_nuits'],
            'reservation_instantanee'     => ['boolean'],
        ];
    }

    public function message(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'slug.string' => 'Le Slug doit être une chaine de caractère.'
        ]; 
    }
}
