<?php

namespace Domain\Common;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entity
 * @package Domain\Entities
 */
abstract class Entity extends Model
{
    use SlugTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * @var \DateTimeInterface
     */
    protected $updatedAt;

    /**
     * @var
     */
    protected $deletedAt;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAtHumansAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}