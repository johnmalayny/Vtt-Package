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
}
