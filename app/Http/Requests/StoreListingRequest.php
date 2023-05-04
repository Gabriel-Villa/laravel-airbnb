<?php

namespace App\Http\Requests;

use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
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
            'category' => 'required|exists:category,id',
            'location' => 'required|exists:location,id',
            'guestCount' => 'required|min:1',
            'roomCount' => 'required|min:1',
            'bathroomCount' => 'required|min:1',
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required|numeric|min:100|max:30000',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['location' => Location::where('code', $this->location)->firstOrFail()->id]);
    }

}
