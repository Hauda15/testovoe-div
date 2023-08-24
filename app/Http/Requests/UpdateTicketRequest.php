<?php

namespace App\Http\Requests;

use App\Enums\TicketStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateTicketRequest extends FormRequest
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
        switch($this->request->get('status', 'Active')) {
            case 'Resolved':
                return [
                    'status' => [new Enum(TicketStatus::class)],
                    'comment' => ['required', 'string']
                ];
                break;
            Default:
                return [
                    'status' => [new Enum(TicketStatus::class)],
                    'comment' => ['string']
                ];
                break;
        }
    }

    public function messages(): array
    {
        return [
            'status' => 'Неверное значение статуса. Возможные значения: Active, Resolved',
            'comment.required' => 'Необходимо ответить в поле (comment: {Текст ответа})',
        ];
    }
}
