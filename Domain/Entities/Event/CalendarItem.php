<?php

namespace Domain\Entities\Event;

use Domain\Common\AggregateRoot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Rennokki\Befriended\Contracts\Likeable;
use Rennokki\Befriended\Traits\CanBeLiked;

/**
 * Class Comment
 * @package Domain\Entities\Comments
 */
class CalendarItem extends AggregateRoot implements Likeable, \MaddHatter\LaravelFullcalendar\Event
{
    use CanBeLiked;

    /**
     * @var string
     */
    protected $table = 'calendar_item';

    /**
     * @var array
     */
    protected $dates = ['start', 'end'];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all of the owning commentable models.
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getCommentAttribute()
    {
        return json_decode($this->data, false)->comment;
    }

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}