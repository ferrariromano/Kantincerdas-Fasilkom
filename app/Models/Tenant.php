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

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}


