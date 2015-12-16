<?php

namespace Thepixeldeveloper\Sitemap;

/**
 * Class Url
 *
 * @package Thepixeldeveloper\Sitemap
 */
class Url implements OutputInterface
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
     * @var string Change frequency of the location
     */
    protected $changeFreq;

    /**
     * @var string Priority of page importance
     */
    protected $priority;

    /**
     * @var OutputInterface[]
     */
    protected $subElements;

    /**
     * Url constructor
     *
     * @param string      $loc
     * @param string|null $lastMod
     * @param string|null $changeFreq
     * @param string|null $priority
     */
    public function __construct($loc, $lastMod = null, $changeFreq = null, $priority = null)
    {
        $this->loc = $loc;
        $this->lastMod = $lastMod;
        $this->changeFreq = $changeFreq;
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * @return null|string
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }

    /**
     * @return null|string
     */
    public function getChangeFreq()
    {
        return $this->changeFreq;
    }

    /**
     * @return null|string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param \XMLWriter $XMLWriter
     */
    public function generateXML(\XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('url');
        $XMLWriter->writeElement('loc', $this->getLoc());

        $this->optionalWriteElement($XMLWriter, 'lastmod', $this->getLastMod());
        $this->optionalWriteElement($XMLWriter, 'changefreq', $this->getChangeFreq());
        $this->optionalWriteElement($XMLWriter, 'priority', $this->getPriority());

        foreach ($this->getSubelements() as $subelement) {
            $subelement->generateXML($XMLWriter);
        }

        $XMLWriter->endElement();
    }

    /**
     * @param \XMLWriter $XMLWriter
     * @param string     $name
     * @param string     $value
     */
    protected function optionalWriteElement(\XMLWriter $XMLWriter, $name, $value)
    {
        if ($value) {
            $XMLWriter->writeElement($name, $value);
        }
    }

    /**
     * @return OutputInterface[]
     */
    public function getSubElements()
    {
        return $this->subElements;
    }

    /**
     * @param OutputInterface $subElement
     *
     * @return $this
     */
    public function addSubElement($subElement)
    {
        $this->subElements[] = $subElement;

        return $this;
    }
}