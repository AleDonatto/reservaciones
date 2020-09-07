<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookins extends Model
{
    //
    protected $table = 'bookings';
    protected $primaryKey = 'idBooking';

    protected $fillable = ['idBooking','businessUnits','idtable','client','B_date','B_hour','pax','status'];
}
