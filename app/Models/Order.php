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
                    ->whereIn('orderStatus', ['Uncompleted'])
                    ->exists();
    }

        // Kalkulasi status pesanan
        public function calculateStatus()
        {
            $items = $this->orderItems;

            $allInProgress = $items->every(function ($item) {
                return $item->isInProgress();
            });
            $allCompleted = $items->every(function ($item) {
                return $item->isCompleted();
            });
            $allPending = $items->every(function ($item) {
                return $item->orderStatus === OrderItem::STATUS_PENDING;
            });

            if ($allInProgress) {
                $this->orderStatus = OrderItem::STATUS_IN_PROGRESS;
            } elseif ($allCompleted) {
                $this->orderStatus = OrderItem::STATUS_COMPLETED;
            } elseif ($allPending) {
                $this->orderStatus = OrderItem::STATUS_PENDING;
            } else {
                $this->orderStatus = OrderItem::STATUS_PENDING;
            }

            $this->save();
        }
}
