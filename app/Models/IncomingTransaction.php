<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'supplier_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(IncomingStock::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d F Y H:i');
    }
}
