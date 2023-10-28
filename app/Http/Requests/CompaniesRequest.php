<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CompaniesRequest extends FormRequest
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
            'name' => 'request|string',
            'logo' => ['',
                File::types(['jpg', 'png', 'pdf'])
                    ->max(5 * 1024),
            ],
            'email' => 'request|email',
            'phone' => 'request',
            'website' => 'request',
            'note' => 'nullable',
        ];
    }
}
