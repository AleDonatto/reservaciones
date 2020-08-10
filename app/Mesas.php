<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    //
    protected $table = 'tables_units';

    protected $primaryKey = 'idTables';

    protected $fillable = [
        'idTables', 'units', 'num_mesa','number_chairs','status'
    ];
}
