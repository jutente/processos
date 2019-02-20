<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $fillable = [
        'descricao', 'numprocesso', 'user_id', 'atual',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
