<?php

namespace App\Services\Comment;

use App\Http\Requests\StoreCommentRequest;
use App\Repositories\CommentRepository;

use App\Services\TreeBuilder;

/**
 * Class CommentService
 *
 * @package App\Services
 */
class CommentService
{

    /**
     * @var \App\Repositories\CommentRepository
     */
    private CommentRepository $commentRepository;

    /**
     * @var \App\Services\TreeBuilder
     */
    private TreeBuilder $treeBuilder;

    /**
     * @var \App\Services\Comment\DetectDeletedItems
     */
    private DetectDeletedItems $deletedItems;

    /**
     * CommentService constructor.
     *
     * @param  \App\Repositories\CommentRepository  $commentRepository
     * @param  \App\Services\TreeBuilder  $treeBuilder
     * @param  \App\Services\Comment\DetectDeletedItems  $deletedItems
     */
    public function __construct(
        CommentRepository $commentRepository,
        TreeBuilder $treeBuilder,
        DetectDeletedItems $deletedItems
    )
    {
        $this->commentRepository = $commentRepository;
        $this->treeBuilder = $treeBuilder;
        $this->deletedItems = $deletedItems;
    }

    /**
     * @return array
     */
    public function tree(): array
    {
        $comments = $this->commentRepository->fetchAll();

        $comments = $this->deletedItems->setData($comments)->get();

        return $this->treeBuilder->setData($comments)->tree();
    }

    /**
     * @param $comments
     * @param  int  $parentId
     *
     * @return array
     */


    /**
     * @param  \App\Http\Requests\StoreCommentRequest  $storeCommentRequest
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function store(StoreCommentRequest $storeCommentRequest)
    {
        return $this->commentRepository->store($storeCommentRequest);
    }

}
