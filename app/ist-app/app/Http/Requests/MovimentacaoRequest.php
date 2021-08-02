<?php


namespace App\Http\Requests;

use App\Http\Requests\Request;

class MovimentacaoRequest extends Request
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "conta_id" => "required|string",
            "valor" => "required|string"
        ];
    }

    public function messages()
    {
        return [
            "conta_id.required" => "Este campo é obrigatório.",
            "valor.required" => "Este campo é obrigatório."
        ];
    }
}
