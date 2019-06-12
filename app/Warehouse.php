<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'articles';

    protected $fillable = ['nombre', 'modelo', 'foto', 'cantidad', 'descripcion', 'anaquel'];

    //
}
