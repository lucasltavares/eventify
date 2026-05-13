<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventFeedback extends Model
{
    use HasFactory;

    protected $appends = ['public_url'];

    protected $fillable = [
        'event_id',
        'rsvp_id',
        'token',
        'recipient_name',
        'recipient_email',
        'recipient_phone',
        'invitation_sent_at',
        'submitted_at',
        'overall_rating',
        'organization_rating',
        'experience_rating',
        'highlight',
        'improvement',
        'would_recommend',
    ];

    protected function casts(): array
    {
        return [
            'invitation_sent_at' => 'datetime',
            'submitted_at' => 'datetime',
            'would_recommend' => 'boolean',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function rsvp(): BelongsTo
    {
        return $this->belongsTo(Rsvp::class);
    }

    public function getPublicUrlAttribute(): string
    {
        return url("/feedback/{$this->token}");
    }
}
