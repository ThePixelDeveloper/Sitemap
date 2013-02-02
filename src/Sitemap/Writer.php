<?php

namespace Sitemap;

abstract class Writer
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}