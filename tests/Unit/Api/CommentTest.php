<?php

namespace Tests\Unit;

use App\Models\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testCountComments()
    {
        $this->assertEquals(160, Comment::count());
    }

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
