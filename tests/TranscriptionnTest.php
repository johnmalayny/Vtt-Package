<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use almond\Transcription\Transcription;

class TranscriptionTest extends TestCase
{
    /** @test */
    public function it_loads_a_vtt_file_as_a_string()
    {
        $this->assertStringContainsString(
            'In this Larabit',
            Transcription::load($file = __DIR__ . '/stubs/basic-example.vtt')
        );

        $this->assertStringContainsString(
            'This is a shortened example',
            Transcription::load($file = __DIR__ . '/stubs/basic-example.vtt')
        );
    }

    /** @test */
    public function it_can_convert_to_an_array_of_lines()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $this->assertCount(4, Transcription::load($file)->lines());
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $this->assertStringNotContainsString('WEBVTT', $transcription = Transcription::load($file));
        $this->assertCount(4, $transcription->lines());
    }
}
