<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

/**
 * Class Sitemap
 *
 * @package Thepixeldeveloper\Sitemap
 */
class Sitemap implements OutputInterface
{
    /**
     * @var string Location (URL)
     */
    protected $loc;

    /**
     * @var string Last modified time
     */
    protected $lastMod;

    /**
     * Url constructor
     *
     * @param string $loc
     */
    public function __construct($loc)
    {
        $this->loc = $loc;
    }

    /**
     * @param XMLWriter $XMLWriter
     */
    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('sitemap');
        $XMLWriter->writeElement('loc', $this->getLoc());

        if ($lastMod = $this->getLastMod()) {
            $XMLWriter->writeElement('lastmod', $lastMod);
        }

        $XMLWriter->endElement();
    }

    /**
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * @return string|null
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }

    /**
     * @param string $lastMod
     */
    public function setLastMod($lastMod)
    {
        $this->lastMod = $lastMod;
    }
}
