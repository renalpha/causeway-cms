<?php

namespace Domain\Entities\Page;

use Domain\Common\AggregateRoot;
use Rennokki\Befriended\Contracts\Likeable;
use Rennokki\Befriended\Traits\CanBeLiked;

/**
 * Class Page
 * @package Domain\Entities\Page
 */
class Page extends AggregateRoot implements Likeable
{
    use \Dimsav\Translatable\Translatable;

    use CanBeLiked;

    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'slug', 'content', 'meta_title', 'meta_description', 'tags'];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @param $value
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = str_replace(['}}', '{{'], ['\}\}', '\{\{'], $value);
    }
}