<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'orderName',
        'orderPhone',
        'orderNotes',
        'orderTotalAmounts',
        'orderStatus',
        'orderPayment',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function hasPendingOrders($uid)
    {
        return self::where('uid', $uid)
                    ->whereIn('orderStatus', ['Pending', 'In Progress'])
                    ->exists();
    }
}
