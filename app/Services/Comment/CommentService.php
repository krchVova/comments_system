<?php

namespace App\Services\Comment;

use App\Http\Requests\StoreCommentRequest;
use App\Repositories\CommentRepository;

use App\Services\TreeBuilder;
use Illuminate\Database\Eloquent\Model;

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
     * @var \App\Services\Comment\DetectionDeletedItems
     */
    private DetectionDeletedItems $deletedItems;

    /**
     * CommentService constructor.
     *
     * @param  \App\Repositories\CommentRepository  $commentRepository
     * @param  \App\Services\TreeBuilder  $treeBuilder
     * @param  \App\Services\Comment\DetectionDeletedItems  $deletedItems
     */
    public function __construct(
        CommentRepository $commentRepository,
        TreeBuilder $treeBuilder,
        DetectionDeletedItems $deletedItems
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
        $comments = $this->deletedItems->setData(
            $this->commentRepository->fetchAll()
        )->get();

        return $this->treeBuilder->setData($comments)->tree();
    }

    /**
     * @param  \App\Http\Requests\StoreCommentRequest  $storeCommentRequest
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function store(StoreCommentRequest $storeCommentRequest): Model
    {
        return $this->commentRepository->store($storeCommentRequest);
    }

}
