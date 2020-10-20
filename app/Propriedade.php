<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contrato;
class Propriedade extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $table = 'propriedades';
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $fillable = ['email_prop','rua','numero','complemento','bairro','cidade','estado','status'];

    //relacionamento one to one
    public function   contrato()
    {
        return $this->hasOne(Contrato::class);
    }

}