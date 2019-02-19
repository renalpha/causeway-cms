<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Event\CalendarItem;
use Domain\Entities\PhotoAlbum\PhotoAlbum;

/**
 * Class EventRepository
 * @package Infrastructure\Repositories
 */
class EventRepository extends AbstractRepository
{
    /**
     * GroupRepository constructor.
     * @param CalendarItem $model
     */
    public function __construct(CalendarItem $model)
    {
        parent::__construct($model);
    }
}