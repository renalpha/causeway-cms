<?php

namespace Domain\Entities\Sound;

use Domain\Common\Entity;
use Rennokki\Befriended\Contracts\Likeable;
use Rennokki\Befriended\Traits\CanBeLiked;

/**
 * Class Sound
 * @package Domain\Entities\Sound
 */
class Sound extends Entity implements Likeable
{
    use CanBeLiked;

    /**
     * @var array
     */
    protected $guarded = [];
}