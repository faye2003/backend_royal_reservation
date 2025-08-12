<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'post_id'      => ['required','exists:posts,id'],
            'user_id'       => ['required','exists:users,id'],
            'date_arrivee'    => ['required','date','after_or_equal:today'],
            'date_depart'     => ['required','date','after:date_arrivee'],
            'nombre_nuits'    => ['required','integer','min:1'],
            'nombre_invites'  => ['required','integer','min:1','max:20'],
            'statut'          => ['in:en_attente,approuve,paye,annule,termine,rembourse'],
            'montant_total'   => ['required','integer','min:0'],
            'devise'          => ['required','string','size:3'],
            'id_paiement_intention' => ['nullable','string','max:255'],
        ];
    }
}
