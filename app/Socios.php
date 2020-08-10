<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socios extends Model
{
    //
    protected $table = 'companies';
    protected $primaryKey = 'idCompanies';

    protected $fillable = ['idCompanies','RFC','name','phone1','phone2','email','website','name_contact','idUser'];
}
