<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $table = 'contas';

    protected $fillable = [
        'id',
        'numero',
        'pessoa_id',
        'saldo'
    ];

    public $timestamps = false;
}
