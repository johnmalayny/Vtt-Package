<?php

namespace almond\Transcription;

class Transcription
{
    protected array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $this->discardInvalidLines($lines);
    }

    public static function load(String $path): self
    {
        $lines = file($path);
        return new static($lines);
    }

    public function __toString()
    {
        return implode('', $this->lines);
    }

    public function lines(): LineCollection
    {
        return new LineCollection(array_map(
            fn ($line) => new Line(...$line),
            array_chunk($this->lines, 3)
        ));
    }

    protected function discardInvalidLines(array $lines):array
    {
        return array_slice(array_filter(array_map('trim', $lines)), 1);
    }
}
