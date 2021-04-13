<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    protected $table = 'cotacaos';

    public $primaryKey = 'id';

    protected $keyType = 'bigInteger';

    protected $casts = [
        'id'            => 'integer',
        'nome'          => 'string',
        'email'         => 'string',
        'de'            => 'string',
        'para'          => 'string',
        'cotacao'       => 'json',
        'ip'            => 'ipAddress',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',        
    ];

    protected $fillable = [      
        'id',
        'nome',
        'email',
        'de',
        'para',
        'cotacao',
        'ip',
    ];

}
