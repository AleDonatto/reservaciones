<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigos extends Model
{
    //
    protected $table = 'code_verifications';

    protected $primaryKey = 'idCode';

    protected $fillable = [
        'idCode', 'code_verification', 'date_expiration','user','companies'
    ];
}
