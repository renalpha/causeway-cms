<?php

namespace Domain\Services;

use App\Jobs\GenerateWaveform;
use Infrastructure\Repositories\SoundRepository;

/**
 * Class SoundService
 * @package Domain\Services
 */
class SoundService extends AbstractService
{
    /**
     * @var string
     */
    public $path = 'sounds';

    /**
     * SoundService constructor.
     * @param SoundRepository $soundRepository
     */
    public function __construct(SoundRepository $soundRepository)
    {
        $this->repository = $soundRepository;
    }

    /**
     * @param array $params
     * @param int|null $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveSound(array $params, int $id = null)
    {
        $params['user_id'] = auth()->user()->id;

        $sound = $this->repository->updateOrCreate([
            'id' => $id ?? null,
        ], $params);

        GenerateWaveform::dispatch($sound);


        return $sound;
    }
}