<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'product_id', 'shoe_size_id', 'quantity', 'price'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shoeSize()
    {
        return $this->belongsTo(ShoeSize::class);
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}
