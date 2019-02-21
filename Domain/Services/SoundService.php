<?php

namespace Domain\Services;

use Infrastructure\Repositories\SoundRepository;

/**
 * Class SoundService
 * @package Domain\Services
 */
class SoundService extends AbstractService
{
    /**
     * SoundService constructor.
     * @param SoundRepository $soundRepository
     */
    public function __construct(SoundRepository $soundRepository)
    {
        $this->repository = $soundRepository;
    }
}