<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return auth()->user()->role === 'admin'; (misal hanya admin yang bisa membuat asset)
        //kalau sudah ada middleware role, bisa langsung return true karena sudah pasti usernya terautentikasi
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            //
            'category_id' => ['required', 'exists:categories,id'],

            'asset_code' => [
                'required',
                'string',
                'max:100',
                'unique:assets,asset_code'
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
                'unique:assets,serial_no'
            ],

            'purchase_date' => [
                'nullable',
                'date'
            ],

            'condition' => [
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
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],
        ];
    }
}
