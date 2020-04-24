<?php

namespace App\Services\Comment;

use App\Http\Resources\DeletedCommentResource;

/**
 * Class TreeBuilder
 *
 * @package App\Services
 */
class DetectDeletedItems
{

    const DELETED_MESSAGE = 'Comment was deleted';

    /**
     * @var iterable|null
     */
    private ?iterable $data;

    /**
     * @param  array  $data
     *
     * @return \App\Services\Comment\DetectDeletedItems
     */
    public function setData(iterable $data): DetectDeletedItems
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return iterable
     */
    public function getData(): ?iterable
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return array_values($this->build($this->data));
    }

    /**
     * @param  array  $comments
     *
     * @return array
     */
    private function build(iterable $comments): array
    {
        $prepared = [];

        foreach ($comments as $comment) {

            if($comment['deleted_at'] !== null) {

                $prepared[] = [
                    'deleted' => true,
                    'message' => self::DELETED_MESSAGE,
                    'id' => $comment->id,
                    'parent_id' => $comment->parent_id,
                ];

                continue;
            }

            $prepared[] = $comment;
        }

        return $prepared;
    }

    /**
     * @param $comments
     *
     * @return \Generator
     */
    private function generator($comments)
    {
        foreach ($comments as $comment) {
            yield $comment;
        }
    }
}
