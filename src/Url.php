<?php

namespace Thepixeldeveloper\Sitemap;

class Url implements OutputInterface
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

    public function generateXML(\XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('url');
        $XMLWriter->writeElement('loc', $this->getLoc());
        $XMLWriter->writeElement('lastmod', $this->getLastMod());
        $XMLWriter->writeElement('changefreq', $this->getChangeFreq());
        $XMLWriter->writeElement('priority', $this->getPriority());
        $XMLWriter->endElement();
    }

    protected function writeElement(\XMLWriter $XMLWriter, $name, $value)
    {
        if ($value) {
            $XMLWriter->writeElement($name, $value);
        }
    }
}
