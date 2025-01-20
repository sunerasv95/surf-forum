<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryFeatureTest extends TestCase
{
    public function test_fetch_all_categories(): void
    {
        // Create some categories with assinged sub-categories
        Category::factory()
        ->hasChildren(2, [ "is_parent" => 0 ])
        ->count(2)->create();

        // Call the API endpoint
        $response = $this->getJson('/api/categories');

        // Assert the response status
        $response->assertStatus(200);

        // Assert the JSON structure of the response
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'name',
                    'slug',
                    'sub_categories' => [
                        '*' => [
                            'name',
                            'slug',
                        ],
                    ],
                ],
            ],
        ]);

        // Assert specific content in the response
        $responseData = $response->json('data');
        $this->assertCount(6, $responseData); //main categories (2) + sub-categories (2 * 2)

        foreach ($responseData as $category) {
            $this->assertArrayHasKey('name', $category);
            $this->assertArrayHasKey('slug', $category);
            $this->assertArrayHasKey('sub_categories', $category);

            foreach ($category['sub_categories'] as $subCategory) {
                $this->assertArrayHasKey('name', $subCategory);
                $this->assertArrayHasKey('slug', $subCategory);
                $this->assertNotEmpty($subCategory['name']);
                $this->assertNotEmpty($subCategory['slug']);
            }
            
            // Assert non-empty values for critical fields
            $this->assertNotEmpty($category['name']);
            $this->assertNotEmpty($category['slug']);
        }
    }
}
