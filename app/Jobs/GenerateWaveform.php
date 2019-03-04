<?php

namespace App\Jobs;

use Domain\Entities\Sound\Sound;
use Domain\Services\SoundService;
use Domain\Services\WaveformService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class GenerateWaveform
 * @package App\Jobs
 */
class GenerateWaveform implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var WaveformService|\Illuminate\Foundation\Application|mixed */
    protected $waveformService;

    /** @var Sound */
    protected $sound;

    /** @var SoundService|\Illuminate\Foundation\Application|mixed */
    protected $soundService;

    /**
     * Create a new job instance.
     *
     * @param Sound $sound
     */
    public function __construct(Sound $sound)
    {
        /** @var WaveformService waveformService */
        $this->waveformService = app(WaveformService::class);

        /** @var SoundService soundService */
        $this->soundService = app(SoundService::class);

        /** @var Sound sound */
        $this->sound = $sound;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = $this->soundService->path;

        $filename = $this->sound->filename;

        $this->waveformService->loadFile(storage_path($path) . $filename);

        $this->waveformService->process();

        $this->waveformService->saveImage($filename); // Saves image to file
    }
}
