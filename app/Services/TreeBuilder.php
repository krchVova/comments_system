<?php

namespace App\Services;

/**
 * Class TreeBuilder
 *
 * @package App\Services
 */
class TreeBuilder
{

    /**
     * @var array|null
     */
    private ?array $data;

    /**
     * @param  array  $data
     *
     * @return TreeBuilder
     */
    public function setData(array $data): TreeBuilder
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function tree(): array
    {
        return array_values($this->build($this->data));
    }

    /**
     * @param  array  $data
     * @param  int  $parentId
     *
     * @return array
     */
    private function build(&$data = [], $parentId = 0): array
    {
        $branch = [];

        foreach ($data as $item) {

            if ($item['parent_id'] == $parentId) {

                $children = $this->build($data, $item['id']);

                $item['children'] = array_values($children);

                $branch[$item['id']] = $item;

                unset($data[$item['id']]);
            }
        }

        return $branch;
    }
}
