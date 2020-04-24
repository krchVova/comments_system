<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FullCommentResource
 *
 * @package App\Http\Resources
 */
class FullCommentResource extends JsonResource
{

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->resource->id,
            'content'    => $this->resource->content,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'children'   => $this->resource->children,
        ];
    }

}
