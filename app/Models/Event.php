<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'slug',
        'cover_image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . Str::random(8);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rsvps(): HasMany
    {
        return $this->hasMany(Rsvp::class);
    }

    public function confirmedRsvps(): HasMany
    {
        return $this->rsvps()->where('status', 'confirmed');
    }

    public function getConfirmedCountAttribute(): int
    {
        return $this->confirmedRsvps()->count();
    }

    public function getPublicUrlAttribute(): string
    {
        return url("/e/{$this->slug}");
    }
}
