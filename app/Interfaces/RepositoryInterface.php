<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface RepositoryInterface
 *
 * @package App\Interfaces
 */
interface RepositoryInterface
{

    /**
     * @param  array|null  $with
     *
     * @return \Illuminate\Support\Collection
     */
    public function fetchAll(array $with = null): Collection;

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fetchOne(int $id): Model;
}
