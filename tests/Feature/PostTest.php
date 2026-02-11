<?php

use App\Models\User;
use App\Models\Post;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('lists all posts', function () {
    Post::factory()->count(3)->create();

    $this->actingAs($this->user)
        ->getJson('/api/dashboard/blog')
        ->assertOk()
        ->assertJsonCount(3, 'data');
});

it('creates a post', function () {
    $this->actingAs($this->user)
        ->postJson('/api/dashboard/blog', [
            'title' => 'Test Post',
            'content' => '<p>Hello world</p>',
            'publish' => false,
        ])
        ->assertCreated()
        ->assertJsonPath('data.title', 'Test Post');

    expect(Post::count())->toBe(1);
});

it('validates required fields on create', function () {
    $this->actingAs($this->user)
        ->postJson('/api/dashboard/blog', [])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['title']);
});

it('shows a single post', function () {
    $post = Post::factory()->create(['title' => 'My Post']);

    $this->actingAs($this->user)
        ->getJson("/api/dashboard/blog/{$post->id}")
        ->assertOk()
        ->assertJsonPath('data.title', 'My Post');
});

it('updates a post', function () {
    $post = Post::factory()->create(['title' => 'Old Title']);

    $this->actingAs($this->user)
        ->putJson("/api/dashboard/blog/{$post->id}", [
            'title' => 'New Title',
            'content' => $post->content,
            'publish' => true,
        ])
        ->assertOk()
        ->assertJsonPath('data.title', 'New Title');
});

it('deletes a post', function () {
    $post = Post::factory()->create();

    $this->actingAs($this->user)
        ->deleteJson("/api/dashboard/blog/{$post->id}")
        ->assertNoContent();

    expect(Post::count())->toBe(0);
});

it('requires authentication for posts', function () {
    $this->getJson('/api/dashboard/blog')
        ->assertUnauthorized();
});
