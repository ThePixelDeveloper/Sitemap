<?php

namespace Sitemap;

abstract class Writer
{
    abstract public function output();

    public function __toString()
    {
        return $this->output();
    }
}