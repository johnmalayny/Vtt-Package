<?php

namespace almond\Transcription;

class Transcription
{
    protected array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $this->discardInvalidLines(array_map('trim', $lines));
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

    public function lines(): array
    {

        return array_map(
            fn($line) => New Line($line[0], $line[1]),
            array_chunk($this->lines, 2)
        );
    }

    public function htmlLines()
    {
        return implode(
            "\n", 
            array_map(fn(Line $line) => $line->toAnchorTag(),$this->lines())
        );
    }

    protected function discardInvalidLines(array $lines):array
    {
        return array_values(array_filter(
            array_map('trim', $lines),
            fn ($line) => Line::valid($line)
        ));
    }
}
