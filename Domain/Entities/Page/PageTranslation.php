<?php

namespace Domain\Entities\Page;

use Domain\Common\SlugTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PageTranslation
 * @package Domain\Entities\Page
 */
class PageTranslation extends Model
{
    use SlugTrait;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set the label value.
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