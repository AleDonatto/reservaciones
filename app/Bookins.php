<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookins extends Model
{
    //
    protected $table = 'bookings';
    protected $primaryKey = 'idBooking';

    protected $fillable = ['idBooking','businessUnits_id','table_id','usuario_id','bdate','bhour','pax','status'];
}
