<?php

namespace almond\Transcription;

class Line
{
    public int $position;
    public string $timestamp;
    public string $body;

    public function __construct(int $position, string $timestamp, string $body)
    {
        $this->position = $position;
        $this->timestamp = $timestamp;
        $this->body = $body;
    }

    public function beginningTimestamp()
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matches);
        return $matches[1];
    }

    public function toAnchorTag()
    {
        return '<a href="?time=' . $this->beginningTimestamp() . '">' . $this->body . '</a>';
    }

    public function toHtml()
    {
        return $this->toAnchorTag();
    }
}
