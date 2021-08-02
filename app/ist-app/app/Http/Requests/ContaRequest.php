<?php


namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContaRequest extends Request
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "pessoa_id" => "required|string",
            "numero" => "required|string|unique:contas"
        ];
    }

    public function messages()
    {
        return [
            "pessoa_id.required" => "Este campo é obrigatório.",
            "numero.required" => "Este campo é obrigatório.",
            "numero.unique" => "Número da conta já existe na base de dados."
        ];
    }
}
