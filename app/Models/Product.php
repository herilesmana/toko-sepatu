<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'buy_price', 'brand_id', 'category_id'];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function sizes() {
        return $this->belongsToMany(ShoeSize::class);
    }    
    
    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    // Format the price to indonesia currency
    public function getFormattedPriceAttribute() {
        return 'Rp' . number_format($this->price, 0, ',', '.').',-';
    }

    // Format the buy price to indonesia currency
    public function getFormattedBuyPriceAttribute() {
        return 'Rp' . number_format($this->buy_price, 0, ',', '.').',-';
    }
}
