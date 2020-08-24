<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //
    protected $table = 'clients';

    protected $primaryKey = 'idClients';

    protected $fillable = [
        'idClients', 'phone', 'date_birth','idUser'
    ];
}
