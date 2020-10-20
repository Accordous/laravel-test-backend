<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    
    protected $table = 'contratos';
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $fillable = ['propriedade_id','tp_pessoa','documento','email_contrat','nome_contrat'];

    //relacionamento one to one
    public function   propriedade()
    {
        return $this->belongsTo(Propriedade::class);
    }
}
