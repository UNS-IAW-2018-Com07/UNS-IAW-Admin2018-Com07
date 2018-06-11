<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Vivienda extends Eloquent {

    protected $collection = 'viviendas';
    protected $guarded = []; 
    // protected $guarded = ['_id','comentarios','calificacion']; 
    // protected $fillable = ['direccion'];
}