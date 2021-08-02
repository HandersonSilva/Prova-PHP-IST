<?php


namespace App\Util;


class AppUtil
{
    public static function limpaCPF_CNPJ($valor){
        $valor = preg_replace('/[^0-9]/', '', $valor);
        return $valor;
    }

    public static function limpaValor($valor){
        $valor = preg_replace('/[^0-9]/', '', $valor);
        return $valor;
    }
}
