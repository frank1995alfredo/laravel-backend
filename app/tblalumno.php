<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tblalumno extends Model
{
    protected $table = 'tblalumno';
    public $timestamps = false; //linea para ignorar el updated_at

    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'edad'
    ];
 
}
