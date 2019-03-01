<?php

namespace Domain\Entities\Menu;

use Domain\Common\Entity;

/**
 * Class MenuItem
 * @package Domain\Entities\Menu
 */
class MenuItem extends Entity
{

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('sequence', 'desc');
    }
}