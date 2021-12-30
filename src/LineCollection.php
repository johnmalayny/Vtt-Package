<?php

namespace almond\Transcription;

use Countable;
use ArrayIterator;
use IteratorAggregate;
use Traversable;

class LineCollection implements Countable, IteratorAggregate
{
    protected array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    public function asHtml()
    {
        return (new static (array_map(
            fn (Line $line) => $line->toAnchorTag(),
            $this->lines
        )))->__toString();
    }

    public function __toString()
    {
        return implode("\n", $this->lines);
    }

    public function count():int
    {
        return count($this->lines);
    }

    public function getIterator():Traversable
    {
        return new ArrayIterator($this->lines);
    }
}
