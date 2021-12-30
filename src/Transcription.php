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
        $lines = [];

        for ($i = 0; $i < count($this->lines); $i += 2) {
            $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }

        return $lines;
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
