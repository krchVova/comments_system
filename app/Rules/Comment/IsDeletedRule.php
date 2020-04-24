<?php

namespace App\Rules\Comment;

use App\Repositories\CommentRepository;
use Illuminate\Contracts\Validation\Rule;

class IsDeletedRule implements Rule
{

    /**
     * @var CommentRepository
     */
    private $repository;

    /**
     * Create a new rule instance.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->repository = app()->make(CommentRepository::class);
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($value === null) {
            return true;
        }

        return (bool) $this->repository->fetchOne($value);
    }

    /**
     * @inheritDoc
     */
    public function message()
    {

    }

}
