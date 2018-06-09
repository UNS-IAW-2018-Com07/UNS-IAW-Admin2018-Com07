<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Propietario extends Eloquent {

    protected $collection = 'propietarios';
    
}