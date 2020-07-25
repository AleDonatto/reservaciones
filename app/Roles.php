<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    protected $table = 'roles';

    protected $primaryKey = 'idRoles';

    protected $fillable = [
        'idRoles', 'tipo', 'descripcion',
    ];
}
