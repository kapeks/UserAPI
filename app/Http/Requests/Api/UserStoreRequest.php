<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:60',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\+380\d{9}$/', // Украина: начинается с +380
            'position_id' => 'required|integer|exists:positions,id', // Для существующих позиций
            'photo' => 'required|image|mimes:jpg,jpeg|dimensions:min_width=70,min_height=70|max:5120', // максимальный размер файла 5MB
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.min' => 'The name must be at least 2 characters.',
            'name.max' => 'The name must not be greater than 60 characters.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.required' => 'The phone number is required.',
            'phone.regex' => 'The phone must start with +380 and contain 9 digits.',
            'position_id.required' => 'The position ID is required.',
            'position_id.integer' => 'The position ID must be an integer.',
            'position_id.exists' => 'The selected position ID is invalid.',
            'photo.required' => 'The photo is required.',
            'photo.image' => 'The photo must be an image (jpeg/jpg).',
            'photo.mimes' => 'The photo must be a jpg/jpeg image.',
            'photo.dimensions' => 'The photo must have a minimum resolution of 70x70px.',
            'photo.max' => 'The photo must not be greater than 5MB.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'fails' => $validator->errors(),
            ], 422)
        );
    }
}
