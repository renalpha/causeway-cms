<?php

namespace Infrastructure\Repositories;

use Domain\Entities\PhotoAlbum\Photo;

/**
 * Class PhotoRepository
 * @package Infrastructure\Repositories
 */
class PhotoRepository extends AbstractRepository
{
    /**
     * GroupRepository constructor.
     * @param Photo $model
     */
    public function __construct(Photo $model)
    {
        parent::__construct($model);
    }
}