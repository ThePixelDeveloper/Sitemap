<?php

namespace Sitemap;

class Sitemap
{
    private $location;

    private $lastMod;

    public function setLastMod($lastMod)
    {
        $this->lastMod = $lastMod;
    }

    public function getLastMod()
    {
        return $this->lastMod;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
