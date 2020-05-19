<?php

namespace Tests\Unit;

use App\Models\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CommentTest
 *
 * @package Tests\Unit
 */
class CommentTest extends TestCase
{

    /**
     * Check count inserted comments
     */
    public function testCountComments()
    {
        $this->assertEquals(160, Comment::count());
    }

    /**
     * Get all comments
     */
    public function testApiGetAllComments()
    {
        $this->json('GET', 'api/comment')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'content',
                        'parent_id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'children',
                    ],
                ],
            ]);
    }

    /**
     * Store comment
     */
    public function testApiStoreComment()
    {
        $this->json('POST', 'api/comment', [
            'parent_id' => null,
            'content'   => 'test comment',
        ])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'content',
                    'created_at',
                    'children',
                ],
            ]);
    }

    /**
     * Update exists comment
     */
    public function testApiUpdateComment()
    {
        $this->json('PUT', 'api/comment/1', [
            'parent_id' => null,
            'content'   => 'test comment (UPDATED)',
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'content',
                    'parent_id',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);
    }

    /**
     * Store reply to comment
     */
    public function testApiStoreChildrenComment()
    {
        $this->json('POST', 'api/comment', [
            'parent_id' => 1,
            'content'   => 'test children comment',
        ])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'content',
                    'created_at',
                    'children',
                ],
            ]);
    }

    /**
     * Delete child comment
     */
    public function testApiDeleteChildrenComment()
    {
        $comment = Comment::count() - 1;

        $this->json('DELETE', 'api/comment/'.$comment, [
            'parent_id' => 1,
            'content'   => 'test children comment',
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'deleted',
                'data' => [
                    'id',
                ],
            ]);
    }

    /**
     * Check 404 response code
     */
    public function testApiNotFoundComment()
    {
        $comment = Comment::count() + 1;

        $this->json('GET', 'api/comment/'.$comment)
            ->assertStatus(404)
            ->assertJsonStructure([
                'status',
                'message',
            ]);
    }

}
