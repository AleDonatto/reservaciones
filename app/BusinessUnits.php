<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessUnits extends Model
{
    //
    protected $table = 'business_units';
    protected $primaryKey = 'idUnits';

    protected $fillable = ['idUnits','idcompany','RFC','nameUnit','phone1','phone2','address','webSite','nameContact','cancelation_time_limit','imagen'];
}
