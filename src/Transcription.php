<?php

namespace almond\Transcription;

class Transcription
{
    protected array $lines;

    public static function load(String $fileName): self
    {
        $instance = new Transcription();
        $instance->lines = $instance->discardIrrelevantLines(file($fileName));
        return $instance;
    }

    public function __toString()
    {
        return implode('', $this->lines);
    }

    public function lines(): array
    {
        return $this->lines;
    }

    protected function discardIrrelevantLines(array $lines):array
    {
        return array_filter(
            array_map('trim', $lines),
            fn ($line) => $line != 'WEBVTT' and $line != '' and !\is_numeric($line)
        );
    }
}
