<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class EventPhotoGalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_owner_can_upload_gallery_photos(): void
    {
        Storage::fake('public');

        $user = $this->createUser();
        $event = $this->createEvent($user);

        $this->actingAs($user)
            ->post("/events/{$event->id}/photos", [
                'photos' => [
                    UploadedFile::fake()->image('party-1.jpg'),
                    UploadedFile::fake()->image('party-2.jpg'),
                ],
            ])
            ->assertSessionHas('success');

        $this->assertDatabaseCount('event_photos', 2);
        Storage::disk('public')->assertExists(EventPhoto::first()->image_path);
    }

    public function test_public_guest_can_upvote_photo_only_once_per_session(): void
    {
        $event = $this->createEvent($this->createUser());
        $photo = EventPhoto::create([
            'event_id' => $event->id,
            'image_path' => 'events/gallery/photo.jpg',
            'sort_order' => 1,
        ]);

        $this->post("/e/{$event->slug}/photos/{$photo->id}/upvote")
            ->assertSessionHas('success');

        $this->post("/e/{$event->slug}/photos/{$photo->id}/upvote")
            ->assertSessionHas('success');

        $this->assertDatabaseCount('event_photo_upvotes', 1);
    }

    public function test_public_guest_can_comment_on_photo(): void
    {
        $event = $this->createEvent($this->createUser());
        $photo = EventPhoto::create([
            'event_id' => $event->id,
            'image_path' => 'events/gallery/photo.jpg',
            'sort_order' => 1,
        ]);

        $this->post("/e/{$event->slug}/photos/{$photo->id}/comments", [
            'author_name' => 'Camila',
            'comment' => 'Esse momento ficou lindo.',
        ])->assertSessionHas('success');

        $this->assertDatabaseHas('event_photo_comments', [
            'event_photo_id' => $photo->id,
            'author_name' => 'Camila',
        ]);
    }

    private function createUser(): User
    {
        return User::create([
            'name' => 'Owner',
            'email' => Str::uuid().'@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    private function createEvent(User $user): Event
    {
        return Event::create([
            'user_id' => $user->id,
            'title' => 'Gallery Event',
            'description' => 'Description',
            'event_date' => today()->addDay()->toDateString(),
            'location' => 'Sao Paulo',
            'slug' => Str::slug(Str::uuid()),
            'is_active' => true,
            'status' => Event::STATUS_SCHEDULED,
        ]);
    }
}
