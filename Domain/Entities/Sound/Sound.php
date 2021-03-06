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

    /**
     * Set the label value.
     *
     * @param $value
     */
    public function setNameAttribute($value): void
    {
        if (isset($value)) {
            if ($value !== $this->name) {
                // Set slug
                $this->attributes['name'] = $this->generateIteratedName('name', $value);
            }
        } else {
            // Otherwise empty the slug
            $this->attributes['name'] = null;
        }
    }
}