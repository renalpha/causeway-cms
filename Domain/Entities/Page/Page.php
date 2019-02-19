<?php

namespace Domain\Entities\Page;

use Domain\Common\AggregateRoot;
use Rennokki\Befriended\Contracts\Likeable;
use Rennokki\Befriended\Traits\CanBeLiked;

/**
 * Class Photo
 * @package Domain\Entities\PhotoAlbum
 */
class Page extends AggregateRoot implements Likeable
{
    use CanBeLiked;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'pages';
}