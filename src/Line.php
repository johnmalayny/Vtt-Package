<?php

namespace almond\Transcription;

class Line
{
    public string $timestamp;
    public string $body;

    public static function valid(string $line):bool
    {
        return $line != 'WEBVTT' and $line != '' and !\is_numeric($line);
    }

    public function __construct(string $timestamp, string $body)
    {
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
}
