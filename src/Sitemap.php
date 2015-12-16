<?php

namespace Thepixeldeveloper\Sitemap;

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
     * @param string      $loc
     * @param string|null $lastMod
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
     * @return string|null
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }

    /**
     * @param \XMLWriter $XMLWriter
     */
    public function generateXML(\XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('sitemap');
        $XMLWriter->writeElement('loc', $this->getLoc());
    
        if ($lastMod = $this->getLastMod()) {
            $XMLWriter->writeElement('lastmod', $lastMod);
        }
    
        $XMLWriter->endElement();
    }
}
