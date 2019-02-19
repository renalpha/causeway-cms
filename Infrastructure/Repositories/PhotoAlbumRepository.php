<?php

namespace Infrastructure\Repositories;

use Domain\Entities\PhotoAlbum\PhotoAlbum;

/**
 * Class PhotoAlbumRepository
 * @package Infrastructure\Repositories
 */
class PhotoAlbumRepository extends AbstractRepository
{
    /**
     * GroupRepository constructor.
     * @param PhotoAlbum $model
     */
    public function __construct(PhotoAlbum $model)
    {
        parent::__construct($model);
    }
}