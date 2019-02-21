<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Sound\Sound;

/**
 * Class SoundRepository
 * @package Infrastructure\Repositories
 */
class SoundRepository extends AbstractRepository
{
    /**
     * PageRepository constructor.
     * @param Sound $model
     */
    public function __construct(Sound $model)
    {
        parent::__construct($model);
    }
}