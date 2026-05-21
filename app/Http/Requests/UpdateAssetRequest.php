<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $assetId = $this->route('asset')->id; // Ambil ID asset dari route parameter

        return [
            //
            'category_id' => [
                'required',
                'exists:categories,id'
            ],

            'asset_code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('assets', 'asset_code')
                    ->ignore($assetId)
            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'brand' => [
                'nullable',
                'string',
                'max:255'
            ],

            'model' => [
                'nullable',
                'string',
                'max:255'
            ],

            'serial_no' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('assets', 'serial_no')
                    ->ignore($assetId)
            ],

            'purchase_date' => [
                'nullable',
                'date'
            ],

            'purchase_price' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'condition' => [
                'required',
                'in:good,minor_damage,broken'
            ],

            'status' => [
                'required',
                'in:available,borrowed,maintenance,retired'
            ],

            'location' => [
                'nullable',
                'string',
                'max:255'
            ],

            'notes' => [
                'nullable',
                'string'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048'
            ]


        ];
    }
}
