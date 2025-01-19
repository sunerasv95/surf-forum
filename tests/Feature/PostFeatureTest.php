<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostFeatureTest extends TestCase
{
    use DatabaseMigrations; //resting the database

    /**
     * Test fetching all posts with associated data.
     */
    public function test_fetch_posts_using_cursor_pagination(): void
    {
        $posts = Post::factory()->count(5)->create();

        // Attach comments to each post
        $posts->each(function ($post) {
            Comment::factory()->count(3)->for($post, 'commentable')->create();
        });

        // Call the API endpoint
        $response = $this->getJson('/api/posts/all');

        // Assert the response status
        $response->assertStatus(200);

        // Assert the JSON structure of the response
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'title',
                    'author',
                    'kind',
                    'tags',
                    'interactions' => [
                        'views_counts',
                        'total_replies',
                    ],
                    'posted_at',
                ],
            ],
            'links' => [
                'next',
                'previous'
            ],
            'meta' => [
                'per_page',
                'count'
            ]
        ]);

        // Assert specific content in the response
        $response->assertJson([
            'status' => 'success',
            'message' => 'OK',
            'links' => [
                'next' => $response->json('links.next'),
                'previous' => $response->json('links.previous') ?? null
            ],
            'meta' => [
                'per_page' => $response->json('meta.per_page'),
                'count' => $response->json('meta.count')
            ]
        ]);

        // Additional assertions for specific data fields
        $responseData = $response->json('data');
        $this->assertCount(5, $responseData); // Ensure 5 posts are returned

        foreach ($responseData as $post) {
            $this->assertArrayHasKey('title', $post);
            $this->assertArrayHasKey('author', $post);
            $this->assertArrayHasKey('kind', $post);
            $this->assertArrayHasKey('tags', $post);
            $this->assertArrayHasKey('interactions', $post);
            $this->assertArrayHasKey('views_counts', $post['interactions']);
            $this->assertArrayHasKey('total_replies', $post['interactions']);
            $this->assertArrayHasKey('posted_at', $post);

            // Assert non-empty values for critical fields
            $this->assertNotEmpty($post['title']);
            $this->assertNotEmpty($post['author']);
            $this->assertNotEmpty($post['kind']);
            $this->assertNotEmpty($post['tags']);
            $this->assertIsArray($post['tags']);
            $this->assertGreaterThanOrEqual(0, $post['interactions']['views_counts']);
            $this->assertGreaterThanOrEqual(0, $post['interactions']['total_replies']);
            $this->assertNotEmpty($post['posted_at']);
        }
    }
}
