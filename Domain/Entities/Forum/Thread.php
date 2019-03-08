<?php

namespace Domain\Entities\Forum;

use Domain\Common\Entity;
use Domain\Entities\Comment\CommentTrait;

/**
 * Class Thread
 * @package Domain\Entities\Forum
 */
class Thread extends Entity
{
    use CommentTrait;

    /**
     * @var string
     */
    protected $table = 'forum_threads';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
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
}