<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Produtos extends Model
{
    use softDeletes;
    protected $dates = ['deleted_at'];

    public function mostrarComentarios() {
        return $this->hasMany('App\Comentario', 'produto_id', 'id');    
    }
}
