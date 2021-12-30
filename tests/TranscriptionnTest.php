<?php

namespace Tests;

use almond\Transcription\Line;
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
    public function it_can_convert_to_an_array_of_line_objects()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $this->assertCount(2, $lines = Transcription::load($file)->lines());
        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
        var_dump($lines);
    }

    /** @test */
    public function it_discards_irrelevant_lines_from_the_vtt_file()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $this->assertStringNotContainsString('WEBVTT', $transcription = Transcription::load($file));
        $this->assertCount(2, $transcription->lines());
    }

    /** @test */
    public function it_renders_the_lines_as_html()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        $expected = <<<EOT
        <a href="?time=00:03">In this Larabit,</a>
        <a href="?time=00:04">This is a shortened example.</a>
        EOT;

        $this->assertEquals($expected, $result = $transcription->htmlLines());
    }
}
