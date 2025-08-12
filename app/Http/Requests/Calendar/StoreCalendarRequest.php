<?php

namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarRequest extends FormRequest
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
            'post_id'           => ['required','exists:posts,id'],
            'date'                 => ['required','date'],
            'est_bloque'           => ['boolean'],
            'prix_modifie'         => ['nullable','integer','min:0'],
            'duree_min_modifiee'   => ['nullable','integer','min:1'],
        ];
    }
}
