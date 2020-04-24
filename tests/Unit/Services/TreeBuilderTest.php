<?php

namespace Tests\Unit\Services;

use App\Services\TreeBuilder;
use Tests\TestCase;

/**
 * Class TreeBuilderTest
 *
 * @package Tests\Unit\Services
 */
class TreeBuilderTest extends TestCase
{

    /**
     * @var TreeBuilder
     */
    private $treeBuilder;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->treeBuilder = app()->make(TreeBuilder::class);
    }

    /**
     * @dataProvider builderDataProvider
     *
     * @param $data
     */
    public function testTreeBuilder($data)
    {
        $this->assertEquals($this->treeBuilder->setData($data)->tree(), $this->completedData());
    }

    public function completedData()
    {
        return [
            [
                "id"        => 1,
                "content"   => "test content",
                "parent_id" => null,
                "children"  => [
                    [
                        "id"        => 2,
                        "content"   => "test content",
                        "parent_id" => 1,
                        "children"  => [
                            [
                                "id"        => 3,
                                "content"   => "test content",
                                "parent_id" => 2,
                                'children' => []
                            ],
                        ],
                    ],
                ],
            ],
            [
                "id"        => 4,
                "content"   => "test content",
                "parent_id" => null,
                'children' => []
            ]
        ];

    }

    public function builderDataProvider()
    {
        return [
            [
                [
                    [
                        'id'        => 1,
                        'content'   => 'test content',
                        'parent_id' => null,
                    ],
                    [
                        'id'        => 2,
                        'content'   => 'test content',
                        'parent_id' => 1,
                    ],
                    [
                        'id'        => 3,
                        'content'   => 'test content',
                        'parent_id' => 2,
                    ],
                    [
                        'id'        => 4,
                        'content'   => 'test content',
                        'parent_id' => null,
                    ],
                ],
            ],
        ];
    }

}
