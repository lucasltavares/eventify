<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class EventPhoto extends Model
{
    use HasFactory;

    protected $appends = ['image_url'];

    protected $fillable = [
        'event_id',
        'image_path',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (EventPhoto $photo) {
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(EventPhotoComment::class)->latest();
    }

    public function upvotes(): HasMany
    {
        return $this->hasMany(EventPhotoUpvote::class);
    }

    public function getImageUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->image_path);
    }
}
