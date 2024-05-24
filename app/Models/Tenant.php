<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tenant extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_tenant';
    protected $fillable = [
        'nama_tenant', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}


