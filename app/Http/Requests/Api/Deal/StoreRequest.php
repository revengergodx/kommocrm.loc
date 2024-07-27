<?php

namespace App\Http\Requests\Api\Deal;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'text' => 'string|required',
            'complete_till' => 'required|numeric',
            'responsible_user_id' => 'nullable|int',
            'duration' => 'nullable|int'
        ];
    }
}
