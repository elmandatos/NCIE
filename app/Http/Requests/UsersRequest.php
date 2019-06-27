<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "nombres" => "required",
            "apellidos" => "required",
            "sexo" => "required",
            "telefono" => "required",
            "email" => "required|email",
            "carrera" => "required",
            "rol" => "required",
            "tipo_de_usuario" => "required",
            "password" => "confirmed",
        ];
    }
}
