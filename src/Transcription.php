<?php

namespace almond\Transcription;

class Transcription
{
    protected string $file;

    public static function load(String $fileName):String
    {
        $instance = new Transcription();
        $instance->file = file_get_contents($fileName);
        return $instance;
    }

    public function __toString()
    {
        return $this->file;
    }
}
