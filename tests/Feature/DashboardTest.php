<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Media;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('returns dashboard stats for authenticated user', function () {
    Post::factory()->count(3)->create(['publish' => true]);
    Post::factory()->count(2)->create(['publish' => false]);

    $this->actingAs($this->user)
        ->getJson('/api/dashboard/')
        ->assertOk()
        ->assertJsonPath('stats.posts_total', 5)
        ->assertJsonPath('stats.posts_published', 3)
        ->assertJsonPath('stats.posts_draft', 2)
        ->assertJsonStructure([
            'stats' => ['posts_total', 'posts_published', 'posts_draft', 'media_total', 'media_size'],
            'recent_posts',
            'recent_media',
        ]);
});

it('requires authentication', function () {
    $this->getJson('/api/dashboard/')
        ->assertUnauthorized();
});
