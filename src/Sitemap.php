<?php

namespace Thepixeldeveloper\Sitemap;

class Sitemap implements OutputInterface
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
