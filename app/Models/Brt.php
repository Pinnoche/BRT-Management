<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brt extends Model
{
    use HasFactory;

    protected $table = 'brts';

    protected $fillable = [
        'brt_code',
        'reserved_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'reserved_amount' => 'decimal:2', // Ensures precise decimal casting
            'status' => 'string',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
