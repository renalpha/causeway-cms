<?php

namespace Domain\Entities\Forum;

use Domain\Common\AggregateRoot;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Thread
 * @package Domain\Entities\Forum
 */
class Category extends AggregateRoot
{
    /**
     * @var string
     */
    protected $table = 'forum_categories';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    /**
     * Set the slug value.
     *
     * @param $value
     */
    public function setSlugAttribute($value): void
    {
        if (isset($value)) {
            if ($value !== $this->slug) {
                // Set slug
                $this->attributes['slug'] = $this->generateIteratedName('slug', $value);
            }
        } else {
            // Otherwise empty the slug
            $this->attributes['slug'] = null;
        }
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeGetParents(Builder $query)
    {
        $query->whereNull('parent_id');

        return $query;
    }

}