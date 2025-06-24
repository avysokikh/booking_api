<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    const DEFAULT_CHECK_IN_HOUR = 14;
    const DEFAULT_CHECK_OUT_HOUR = 12;
    
    protected $fillable = [
        'room_id',
        'user_id',
        'check_in_date',
        'check_out_date',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
    ];

    protected $with = [
        'user',
        'room'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
