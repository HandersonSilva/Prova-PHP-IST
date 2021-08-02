<?php


namespace App\Http\Requests;

use App\Http\Requests\Request;

class PessoaRequest extends Request
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nome" => "required|string",
            "cpf" => "required|string",
            "endereco" => "required|string"
        ];
    }

    public function messages()
    {
        return [
            "nome.required" => "Este campo é obrigatório.",
            "cpf.required" => "Este campo é obrigatório.",
            "endereco.required" => "Este campo é obrigatório.",
        ];
    }
}
