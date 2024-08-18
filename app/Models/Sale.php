<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['total_amount', 'user_id'];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum('total');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
