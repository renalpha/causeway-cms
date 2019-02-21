<?php

namespace Domain\Entities\Menu;

use Domain\Common\AggregateRoot;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Menu
 * @package Domain\Entities\Menu
 */
class Menu extends AggregateRoot
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
        return $this->hasMany(MenuItem::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeGetParents(Builder $query)
    {
        $query->whereHas('items', function (Builder $query) {
            return $query->whereNull('access_level')
                ->whereNUll('parent_id');
        })
            ->with(['items' => function (HasMany $query) {
                return $query->whereNull('access_level')
                    ->whereNUll('parent_id');
            }]);

        return $query;
    }
}