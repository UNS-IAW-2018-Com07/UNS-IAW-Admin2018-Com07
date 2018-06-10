<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Vivienda extends Eloquent {

    protected $collection = 'viviendas';
    protected $guarded = ['_id','comentarios','calificacion']; 
}