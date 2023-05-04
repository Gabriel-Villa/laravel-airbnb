<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'startDate' => 'required|date_format:Y-m-d|before:endDate',
            'endDate' => 'required|date_format:Y-m-d|after:startDate',
            'listingId' => 'required|exists:listing,id',
        ];
    }
}
