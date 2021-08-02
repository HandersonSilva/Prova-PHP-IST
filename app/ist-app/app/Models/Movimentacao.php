<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'historico';

    protected $fillable = [
        'id',
        'conta_id',
        'valor',
        'created_at'
    ];

    public $timestamps = false;
}
