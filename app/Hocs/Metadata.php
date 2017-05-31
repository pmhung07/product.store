<?php

namespace App\Hocs;

class Metadata {

    protected $metadata = [];

    public function __set($key, $value)
    {
        $this->metadata[$key] = $value;
    }

    public function __get($key)
    {
        return isset($this->metadata[$key]) ? $this->metadata[$key] : null;
    }

    public function toArray()
    {
        return $this->metadata;
    }
}