<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'menus' => 'required|array',
            'menus.*.menu_id' => [
                'required',
                'integer',
                Rule::exists('menus', 'id')
            ],
        ];
    }
}
