<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_list_all_posts()
    {
        Post::factory()->count(5)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function it_can_create_a_post()
    {
        $data = [
            'title' => 'Sample Post',
            'content' => 'This is a sample content.',
        ];

        $response = $this->postJson('/api/posts', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment($data);

        $this->assertDatabaseHas('posts', $data);
    }

    public function it_can_show_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->getJson("/api/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'title' => $post->title,
            'content' => $post->content,
        ]);
    }

    public function it_can_update_a_post()
    {
        $post = Post::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ];

        $response = $this->putJson("/api/posts/{$post->id}", $data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);

        $this->assertDatabaseHas('posts', $data);
    }

    public function it_can_delete_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Post deleted successfully']);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }
}