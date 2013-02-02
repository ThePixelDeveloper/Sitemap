<?php

namespace Sitemap;

abstract class Writer
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    abstract public function output();

    public function __toString()
    {
        return $this->output();
    }
}