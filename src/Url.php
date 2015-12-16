<?php

namespace Thepixeldeveloper\Sitemap;

class Url
{
    protected $loc;

    protected $lastMod;

    protected $changeFreq;

    protected $priority;

    /**
     * Url constructor.
     *
     * @param string $loc
     * @param null   $lastMod
     * @param null   $changeFreq
     * @param null   $priority
     */
    public function __construct($loc, $lastMod = null, $changeFreq = null, $priority = null)
    {
        $this->loc = $loc;
        $this->lastMod = $lastMod;
        $this->changeFreq = $changeFreq;
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * @return mixed
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }

    /**
     * @return mixed
     */
    public function getChangeFreq()
    {
        return $this->changeFreq;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }
}
