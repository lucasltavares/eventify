<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rsvp extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
        'guests_count',
    ];

    protected $casts = [
        'guests_count' => 'integer',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_DECLINED = 'declined';

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
