<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookins extends Model
{
    //
    protected $table = 'bookings';
    protected $primaryKey = 'idBooking';

    protected $fillable = ['idBooking','businessUnits','table','client','date','hour','pax','status'];
}
