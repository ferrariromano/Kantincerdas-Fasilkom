<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Nutrition extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'kalori',
        'lemak',
        'gula',
        'karbohidrat',
        'protein',
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class);
    }
}
