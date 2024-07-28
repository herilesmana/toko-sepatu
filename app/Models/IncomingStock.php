<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingStock extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'shoe_size_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shoeSize()
    {
        return $this->belongsTo(ShoeSize::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d F Y H:i');
    }
}
