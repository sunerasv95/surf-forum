<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostFeatureTest extends TestCase
{
    public $postResourceRoute = "/api/posts/";

    /**
     * Test fetching all posts with associated data.
     */
    public function test_fetch_posts_with_pagination(): void
    {
        $posts = Post::factory()->count(5)->create();

        // Attach comments to each post
        $posts->each(function ($post) {
            Comment::factory()->count(3)->for($post, 'commentable')->create();
        });

        // Call the API endpoint
        $response = $this->get($this->postResourceRoute);

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

     /**
     * Test filtering posts by category.
     */
    public function test_filter_posts_by_category(): void
    {
        // Create categories
        $category1 = Category::factory()->create([
            'category_name' => 'Category 1',
            'category_slug' => 'category-1'
        ]);
        $category2 = Category::factory()->create([
            'category_name' => 'Category 2',
            'category_slug' => 'category-2'
        ]);

        // Create posts and assign them to categories
        Post::factory()->count(3)->create(['category_id' => $category1->id]);
        Post::factory()->count(2)->create(['category_id' => $category2->id]);

        // Call the API endpoint with category filter
        $response = $this->get("{$this->postResourceRoute}?cat=category-1");

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
        $responseData = $response->json('data');
        $this->assertCount(3, $responseData); // Ensure 3 posts are returned for category-1

        foreach ($responseData as $post) {
            $this->assertEquals('Category 1', $post['kind']);
        }
    }

    /**
     * Test searching posts by keyword.
     */
    public function test_search_posts_by_keyword(): void
    {
        // Create posts with specific keywords in the title
        Post::factory()->create(['topic' => 'Laravel Testing']);
        Post::factory()->create(['topic' => 'PHP Unit Testing']);
        Post::factory()->create(['topic' => 'JavaScript Testing']);
        Post::factory()->create(['topic' => 'Vue.js Testing']);
        Post::factory()->create(['topic' => 'React Testing']);

        // Call the API endpoint with search keyword
        $response = $this->get("{$this->postResourceRoute}?keyword=Testing");

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
        $responseData = $response->json('data');
        $this->assertCount(5, $responseData); // Ensure 5 posts are returned for the keyword "Testing"

        foreach ($responseData as $post) {
            $this->assertStringContainsString('Testing', $post['title']);
        }
    }

    /**
     * Test sorting posts by specific keys.
     */
    public function test_sort_posts_by_key(): void
    {
        // Create posts with different attributes
        $post1 = Post::factory()->create(['topic' => 'Post 1', 'created_at' => now()->subDays(3), 'view_count' => 10]);
        $post2 = Post::factory()->create(['topic' => 'Post 2', 'created_at' => now()->subDays(1), 'view_count' => 30]);
        $post3 = Post::factory()->create(['topic' => 'Post 3', 'created_at' => now()->subDays(2), 'view_count' => 20]);

        // Attach comments to each post
        Comment::factory()->count(5)->create(['commentable_id' => $post1->id, 'commentable_type' => Post::class]);
        Comment::factory()->count(15)->create(['commentable_id' => $post2->id, 'commentable_type' => Post::class]);
        Comment::factory()->count(10)->create(['commentable_id' => $post3->id, 'commentable_type' => Post::class]);

        // Test sorting by latest
        $response = $this->get("{$this->postResourceRoute}?sort=latest");
        $response->assertStatus(200);
        $responseData = $response->json('data');
        $this->assertEquals('Post 2', $responseData[0]['title']);
        $this->assertEquals('Post 3', $responseData[1]['title']);
        $this->assertEquals('Post 1', $responseData[2]['title']);

        // Test sorting by views
        $response = $this->get("{$this->postResourceRoute}?sort=views");
        $response->assertStatus(200);
        $responseData = $response->json('data');
        $this->assertEquals('Post 2', $responseData[0]['title']);
        $this->assertEquals('Post 3', $responseData[1]['title']);
        $this->assertEquals('Post 1', $responseData[2]['title']);

        // Test sorting by comments
        $response = $this->get("{$this->postResourceRoute}?sort=comments");
        $response->assertStatus(200);
        $responseData = $response->json('data');
        //dd($responseData);
        $this->assertEquals('Post 2', $responseData[0]['title']);
        $this->assertEquals('Post 3', $responseData[1]['title']);
        $this->assertEquals('Post 1', $responseData[2]['title']);
    }
}
