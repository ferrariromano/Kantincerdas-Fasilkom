<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'tenant_id',
        'quantity',
        'price',
        'orderStatus',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Define statuses
    const STATUS_PENDING = 'Pending';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_COMPLETED = 'Completed';
    // const STATUS_CANCELLED = 'Cancelled';

    // Methods to check status
    public function isPending() {
        return $this->orderStatus === self::STATUS_PENDING;
    }
    public function isInProgress() {
        return $this->orderStatus === self::STATUS_IN_PROGRESS;
    }
    public function isCompleted() {
        return $this->orderStatus === self::STATUS_COMPLETED;
    }
    // public function isCancelled() {
    //     return $this->orderStatus === self::STATUS_CANCELLED;
    // }
}
