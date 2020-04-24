<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DeletedCommentResource
 *
 * @package App\Http\Resources
 */
class DeletedCommentResource extends JsonResource
{

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'deleted' => true,
            'data' => [
                'id' => $this->resource->id,
                'parent_id' => $this->resource->parent_id,
            ]
        ];
    }
}
