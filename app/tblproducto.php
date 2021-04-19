<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tblproducto extends Model
{
    protected $table = 'tblproducto';
    public $timestamps = false; //linea para ignorar el updated_at

    protected $fillable = [
        'id',
        'idcategoria',
        'descripcion',
        'precio',
        'cantidad',
    ];
}
