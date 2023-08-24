<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'message' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
          'name.required' => 'Необходимо указать имя пользователя',
          'email.required' => 'Необходимо указать электронную почту пользователя',
          'message.required' => 'Сообщение не может быть пустым',
        ];
    }
}
