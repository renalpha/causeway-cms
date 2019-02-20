<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\Services\WaveformService;

class SoundController extends Controller
{
    /**
     * @var WaveformService
     */
    protected $waveformService;

    /**
     * SoundController constructor.
     * @param WaveformService $waveformService
     */
    public function __construct(WaveformService $waveformService)
    {
        $this->waveformService = $waveformService;

        $this->waveformService->setHeight(200);

        $this->waveformService->setWidth(1200);

        $this->waveformService->setBackground('');

        $this->waveformService->setForeground('#35cc32');

        $this->waveformService->setDetail(40);

        $this->waveformService->setType('bars');
    }

    public function foobar()
    {
        $this->waveformService->loadFile(public_path() . "/test.mp3");

        $this->waveformService->process();

        $this->waveformService->saveImage('waveform_example.png'); // Saves image to file

        return $this->waveformService->outputImage(); // Outputs image to browser
    }
}