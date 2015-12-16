<?php

namespace Thepixeldeveloper\Sitemap;

class Sitemap
{
    protected $loc;

    protected $lastMod;

    /**
     * Url constructor.
     *
     * @param string $loc
     * @param null   $lastMod
     */
    public function __construct($loc, $lastMod = null)
    {
        $this->loc = $loc;
        $this->lastMod = $lastMod;
    }

    /**
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * @return null
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }
}
