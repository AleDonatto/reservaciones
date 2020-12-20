<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUnits extends Model
{
    //
    protected $table = 'users_units';
    protected $primaryKey = 'idUsersUnits';

    protected $fillable = ['idUsersUnits','user_id','unit_id'];
}
