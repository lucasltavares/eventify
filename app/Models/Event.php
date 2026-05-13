<?php

namespace App\Models;

use App\Mail\EventFeedbackInvitationMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $appends = ['cover_image_url'];

    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_FINISHED = 'finished';

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
        'status',
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

            $event->status = $event->resolveStatus();
        });

        static::updating(function ($event) {
            $event->status = $event->resolveStatus();
        });

        static::deleting(function (Event $event) {
            if ($event->cover_image) {
                Storage::disk('public')->delete($event->cover_image);
            }

            $event->photos()->get()->each(function (EventPhoto $photo) {
                if ($photo->image_path) {
                    Storage::disk('public')->delete($photo->image_path);
                }
            });
        });
    }

    public static function syncStatuses(): void
    {
        static::query()
            ->whereDate('event_date', '<', today())
            ->where('status', '!=', self::STATUS_FINISHED)
            ->update(['status' => self::STATUS_FINISHED]);

        static::query()
            ->whereDate('event_date', '>=', today())
            ->where('status', '!=', self::STATUS_SCHEDULED)
            ->update(['status' => self::STATUS_SCHEDULED]);

        static::query()
            ->where('status', self::STATUS_FINISHED)
            ->with(['confirmedRsvps', 'feedbacks'])
            ->get()
            ->each
            ->ensureFeedbackInvitesDispatched();
    }

    public function resolveStatus(): string
    {
        return $this->event_date && $this->event_date->isBefore(today())
            ? self::STATUS_FINISHED
            : self::STATUS_SCHEDULED;
    }

    public function isFinished(): bool
    {
        return $this->status === self::STATUS_FINISHED;
    }

    public function ensureFeedbackInvitesDispatched(): void
    {
        if (! $this->isFinished()) {
            return;
        }

        $this->loadMissing(['confirmedRsvps', 'feedbacks']);

        $feedbacksByRsvp = $this->feedbacks->keyBy('rsvp_id');

        foreach ($this->confirmedRsvps as $rsvp) {
            $feedback = $feedbacksByRsvp->get($rsvp->id);

            if (! $feedback) {
                $feedback = $this->feedbacks()->create([
                    'rsvp_id' => $rsvp->id,
                    'token' => Str::random(40),
                    'recipient_name' => $rsvp->name,
                    'recipient_email' => $rsvp->email,
                    'recipient_phone' => $rsvp->phone,
                ]);

                $feedbacksByRsvp->put($rsvp->id, $feedback);
            }

            if ($feedback->recipient_email && ! $feedback->invitation_sent_at) {
                Mail::to($feedback->recipient_email)->send(new EventFeedbackInvitationMail($feedback));

                $feedback->forceFill([
                    'invitation_sent_at' => now(),
                ])->save();
            }
        }
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

    public function feedbacks(): HasMany
    {
        return $this->hasMany(EventFeedback::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(EventQuestion::class)->latest();
    }

    public function photos(): HasMany
    {
        return $this->hasMany(EventPhoto::class)->orderBy('sort_order')->orderByDesc('created_at');
    }

    public function getConfirmedCountAttribute(): int
    {
        return $this->confirmedRsvps()->count();
    }

    public function getPublicUrlAttribute(): string
    {
        return url("/e/{$this->slug}");
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if (! $this->cover_image) {
            return null;
        }

        return Storage::disk('public')->url($this->cover_image);
    }
}
