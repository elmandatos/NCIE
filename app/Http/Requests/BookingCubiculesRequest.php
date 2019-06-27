<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingCubiculesRequest extends FormRequest
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
            "id_user" => "required",
            "id_cubicules" => "required",
            "id_schedules" => "required|array|between:1,2",
        ];
    }

    public function messages(){
        return[
            "id_user.required" => "Falta asociar renta a un QR",
            "id_schedules.required" => "Falta seleccionar horarios",
            "id_schedules.between" => "Solo se pueden seleccionar hasta 2 horarios"
        ];
    }
}
