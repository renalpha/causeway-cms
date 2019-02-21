<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostSoundRequest;
use Domain\Entities\Sound\Sound;
use Domain\Services\SoundService;
use Domain\Services\WaveformService;
use Illuminate\Http\Request;

class SoundController extends Controller
{
    /**
     * @var WaveformService
     */
    protected $waveformService;

    /**
     * @var SoundService
     */
    protected $soundService;

    /**
     * SoundController constructor.
     * @param SoundService $soundService
     * @param WaveformService $waveformService
     */
    public function __construct(SoundService $soundService, WaveformService $waveformService)
    {
        $this->soundService = $soundService;
        $this->waveformService = $waveformService;

        $this->waveformService->setHeight(100);

        $this->waveformService->setWidth(508);

        $this->waveformService->setBackground('');

        $this->waveformService->setForeground('#ffffff');

        $this->waveformService->setDetail(100);

        $this->waveformService->setType('waveform');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.sound.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.new');
    }

    /**
     * @param Request $request
     * @param Sound $sound
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Sound $sound)
    {
        return view('admin.sound.edit', [
            'page' => $sound,
        ]);
    }

    /**
     * @param PostSoundRequest $request
     * @param Sound $sound
     */
    public function update(PostSoundRequest $request, Sound $sound)
    {
        $page = $this->store($request, $sound);
    }

    public function store(PostSoundRequest $request, Sound $sound = null)
    {

    }

    public function foobar()
    {
        $this->waveformService->loadFile(public_path() . "/test.mp3");

        $this->waveformService->process();

        $this->waveformService->saveImage('waveform_example.png'); // Saves image to file

        return $this->waveformService->outputImage(); // Outputs image to browser
    }

    public function play()
    {
        return view('sound.play');
    }
}