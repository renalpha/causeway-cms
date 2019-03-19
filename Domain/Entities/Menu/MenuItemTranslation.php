<?php

namespace Domain\Entities\Menu;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuItemTranslation
 * @package Domain\Entities\Menu
 */
class MenuItemTranslation extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var bool
     */
    public $timestamps = false;
}