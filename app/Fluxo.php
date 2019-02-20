<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fluxo extends Model
{
    protected $fillable = [
        'descricao', 'user_id', 'setor_id', 'processo_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setor()
    {
        return $this->belongsTo('App\Setor');
    }

    public function processo()
    {
        return $this->belongsTo('App\Processo');
    }

}
