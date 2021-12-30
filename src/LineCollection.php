<?php

namespace almond\Transcription;

use ArrayAccess;
use Countable;
use ArrayIterator;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

class LineCollection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
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

    public function offsetExists($key):bool
    {
        return isset($this->lines[$key]);
    }

    public function offsetGet($key)
    {
        return $this->lines[$key];
    }

    public function offsetSet($key, $value):void
    {
        if (is_null($key)) {
            $this->lines[] = $value;
        } else {
            $this->lines[$key] = $value;
        }
    }

    public function offsetUnset($key):void
    {
        unset($this->lines[$key]);
    }

    public function jsonSerialize()
    {
        return $this->lines;
    }
}
