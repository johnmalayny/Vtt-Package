<?php

namespace almond\Transcription;

use Countable;
use ArrayAccess;
use Traversable;
use ArrayIterator;
use JsonSerializable;
use IteratorAggregate;

class Collection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable
{
    protected array $items;

    public function count():int
    {
        return count($this->items);
    }

    public function getIterator():Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function offsetExists($key):bool
    {
        return isset($this->items[$key]);
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function offsetSet($key, $value):void
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function offsetUnset($key):void
    {
        unset($this->items[$key]);
    }

    public function jsonSerialize()
    {
        return $this->items;
    }

    public function map(callable $fn)
    {
        return new static(
            array_map($fn, $this->items)
        );
    }
}
