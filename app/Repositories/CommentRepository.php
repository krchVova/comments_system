<?php

namespace App\Repositories;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Interfaces\RepositoryInterface;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class CommentRepository
 *
 * @package App\Repositories
 */
class CommentRepository implements RepositoryInterface
{

    /**
     * @var Comment
     */
    private Comment $model;

    /**
     * CommentRepository constructor.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->model = app()->make(Comment::class);
    }

    /**
     * @param  array|null  $with
     *
     * @return \Illuminate\Support\Collection
     */
    public function fetchAll(array $with = null): Collection
    {
        $builder = $this->model->withTrashed();

        if($with !== null) {
            $builder = $builder->with($with);
        }

        return $builder->orderBy('id','desc')->get();
    }

    /**
     * @param  int  $id
     *
     * @return Comment|\Illuminate\Database\Eloquent\Model
     */
    public function fetchOne(int $id): Comment
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    /**
     * @param  int  $id
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     *
     * @return \App\Models\Comment|null
     */
    public function update(int $id, UpdateCommentRequest $request): ?Comment
    {
        $comment = $this->model->newQuery()->findOrFail($id);

        return tap($comment)->update($request->all());
    }

    /**
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function store(StoreCommentRequest $request): Model
    {
        return $this->model->newQuery()->create($request->all());
    }

    /**
     * @param  int  $id
     *
     * @return \App\Models\Comment
     * @throws \Exception
     */
    public function destroy(int $id): Comment
    {
        /** @var Comment $comment */
        $comment = $this->model->newQuery()->findOrFail($id);

        if($comment->delete()) {
            return $comment;
        }

        throw new \Exception('Comment was not deleted');
    }

}
