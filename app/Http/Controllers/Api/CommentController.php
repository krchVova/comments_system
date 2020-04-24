<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentsResource;
use App\Http\Resources\DeletedCommentResource;
use App\Http\Resources\FullCommentResource;
use App\Repositories\CommentRepository;
use App\Services\Comment\CommentService;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\Api
 */
class CommentController extends Controller
{

    /**
     * @var \App\Repositories\CommentRepository
     */
    private CommentRepository $commentRepository;

    /**
     * @var \App\Services\Comment\CommentService
     */
    private CommentService $commentService;

    /**
     * CommentController constructor.
     *
     * @param  \App\Repositories\CommentRepository  $commentRepository
     * @param  \App\Services\Comment\CommentService  $commentService
     */
    public function __construct(
        CommentRepository $commentRepository,
        CommentService $commentService
    )
    {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    /**
     * @return \App\Http\Resources\CommentsResource
     */
    public function index(): CommentsResource
    {
        return new CommentsResource($this->commentService->tree());
    }

    /**
     * @param int $id
     *
     * @return \App\Http\Resources\CommentResource
     */
    public function show(int $id): CommentResource
    {
        return new CommentResource($this->commentRepository->fetchOne($id));
    }

    /**
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     *
     * @return \App\Http\Resources\FullCommentResource
     */
    public function store(StoreCommentRequest $request): FullCommentResource
    {
        return new FullCommentResource($this->commentService->store($request));
    }

    /**
     * @param  int  $id
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     *
     * @return \App\Http\Resources\CommentResource
     */
    public function update(int $id, UpdateCommentRequest $request): CommentResource
    {
        return new CommentResource($this->commentRepository->update($id, $request));
    }

    /**
     * @param  int  $id
     *
     * @return \App\Http\Resources\DeletedCommentResource
     * @throws \Exception
     */
    public function destroy(int $id): DeletedCommentResource
    {
        return new DeletedCommentResource($this->commentRepository->destroy($id));
    }
}
