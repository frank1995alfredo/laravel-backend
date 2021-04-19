<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tblcategoria extends Model
{
    protected $table = 'tblcategoria';
    public $timestamps = false; //linea para ignorar el updated_at

    protected $fillable = [
        'id',
        'descripcion'
    ];
 
}
