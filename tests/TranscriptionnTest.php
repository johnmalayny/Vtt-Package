<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use almond\Transcription\Transcription;

class TranscriptionTest extends TestCase
{
    /** @test */
    public function it_loads_a_vtt_file()
    {
        $transcription = Transcription::load($file = __DIR__ . '/stubs/basic-example.vtt');
        $expected = \file_get_contents($file);
        $this->assertEquals($expected, $transcription);
    }
}
