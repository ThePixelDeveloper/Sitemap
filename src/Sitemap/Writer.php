<?php

namespace Sitemap;

use Sitemap\Writers\OutputInterface;

abstract class Writer implements OutputInterface
{
    public function __toString()
    {
        return $this->output();
    }
}