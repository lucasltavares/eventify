<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Rsvp extends Model
{
    use HasFactory;

    protected $appends = ['support_url'];

    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
        'guests_count',
        'support_token',
    ];

    protected $casts = [
        'guests_count' => 'integer',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_DECLINED = 'declined';

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($rsvp) {
            if (empty($rsvp->support_token)) {
                $rsvp->support_token = Str::random(40);
            }
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(EventFeedback::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(EventQuestion::class)->latest();
    }

    public function getSupportUrlAttribute(): string
    {
        return url("/support/{$this->support_token}");
    }
}
