<?php

namespace Tests\Unit\Services;

use Domain\Services\WaveformService;
use Tests\TestCase;

class WaveformServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        /** @var WaveformService $waveformService */
        $waveformService = app(WaveformService::class);

        $this->assertTrue(true);
    }
}
