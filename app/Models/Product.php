<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'category_id',
        'tenant_id',
        'name',
        'price',
        'image',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function nutritions()
    {
        return $this->hasOne(nutritions::class);
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
