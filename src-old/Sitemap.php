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
     * Location (URL).
     *
     * @var string
     */
    protected $loc;

    /**
     * Last modified time.
     *
     * @var string
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
     * {@inheritdoc}
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
     * Get location (URL).
     *
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * Get the last modification time.
     *
     * @return string|null
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }

    /**
     * Set the last modification time.
     *
     * @param string $lastMod
     *
     * @return $this
     */
    public function setLastMod($lastMod)
    {
        $this->lastMod = $lastMod;

        return $this;
    }
}
