<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostSoundRequest;
use App\Jobs\GenerateWaveform;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostSoundRequest $request, Sound $sound)
    {
        return $this->store($request, $sound);
    }

    /**
     * @param PostSoundRequest $request
     * @param Sound|null $sound
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostSoundRequest $request, Sound $sound = null)
    {
        $soundRecord = $this->soundService->saveSound($request->only([
            'artist', 'title', 'description', 'file',
        ]), $sound->id ?? null);

        $request->session()->flash('status', 'Sound ' . $soundRecord->title . ' uploaded.');

        return redirect()
            ->to(route('admin.sounds.index'));
    }

    public function foobar()
    {
        $this->waveformService->loadFile(public_path() . "/test.mp3");

        $this->waveformService->process();

        $this->waveformService->saveImage('waveform_example.png'); // Saves image to file

        GenerateWaveform::dispatch();

        return $this->waveformService->outputImage(); // Outputs image to browser
    }

    public function play()
    {
        return view('sound.play');
    }
}