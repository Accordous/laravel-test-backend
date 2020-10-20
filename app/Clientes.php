<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{

    protected $table = 'tbtest';
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $fillable = [
        'nome',
    ];
}
