<?php

namespace App\Http\Requests;

use App\Models\Resident;
use Illuminate\Foundation\Http\FormRequest;

class StoreResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->id == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'barangay_id' => 'required',
        ];
    }

    /**
     * Additional data to be added when storing
     */
    public function validated()
    {
        return array_merge(parent::validated(), [
            'verified' => true,
            'resident_number' => Resident::verified()->latest()->first()?->resident_number + 1
        ]);
    }
}
