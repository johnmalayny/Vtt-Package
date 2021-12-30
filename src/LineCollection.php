<?php

namespace almond\Transcription;

class LineCollection extends Collection
{
    public function asHtml():string
    {
        return $this->map(fn (Line $line) => $line->toHtml());
    }

    public function __toString()
    {
        return implode("\n", $this->items);
    }
}
