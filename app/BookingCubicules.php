<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingCubicules extends Model
{
    public $timestamps = false;
    protected $table = "booking_cubicules";
    protected $fillable = ['id_schedules', 'id_cubicules', 'id_user', 'fecha'];
}
