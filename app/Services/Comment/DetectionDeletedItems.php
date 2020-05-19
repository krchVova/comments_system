<?php

namespace App\Services\Comment;

/**
 * Class TreeBuilder
 *
 * @package App\Services
 */
class DetectionDeletedItems
{

    const DELETED_MESSAGE = 'Comment was deleted';

    /**
     * @var iterable|null
     */
    private ?iterable $data;

    /**
     * @param  array  $data
     *
     * @return \App\Services\Comment\DetectionDeletedItems
     */
    public function setData(iterable $data): DetectionDeletedItems
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
}
