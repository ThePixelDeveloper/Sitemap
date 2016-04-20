<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

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
    protected $subElements = [];
    /**
     * @var array
     */
    protected $seenClasses = [];

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
        foreach ($this->getSubelements() as $subelement) {
            if (!$this->hasSeenClass($subelement) && $subelement instanceof AppendAttributeInterface) {
                $subelement->appendAttributeToCollectionXML($XMLWriter);
                $this->seeClass($subelement);
            }
        }

        $XMLWriter->startElement('url');
        $XMLWriter->writeElement('loc', $this->getLoc());

        $this->optionalWriteElement($XMLWriter, 'lastmod', $this->getLastMod());
        $this->optionalWriteElement($XMLWriter, 'changefreq', $this->getChangeFreq());
        $this->optionalWriteElement($XMLWriter, 'priority', $this->getPriority());

        foreach ($this->getSubelements() as $subelement) {
            if ($subelement instanceof OutputInterface) {
                $subelement->generateXML($XMLWriter);
            }
        }

        $XMLWriter->endElement();
    }

    /**
     * @return OutputInterface[]
     */
    public function getSubElements()
    {
        return $this->subElements;
    }

    /**
     * @param $object
     *
     * @return bool
     */
    protected function hasSeenClass($object)
    {
        return in_array(get_class($object), $this->seenClasses, true);
    }

    /**
     * @param $object
     *
     * @return $this
     */
    protected function seeClass($object)
    {
        $this->seenClasses[] = get_class($object);

        return $this;
    }

    /**
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * Only write the XML element if it has a truthy value.
     *
     * @param XMLWriter $XMLWriter
     * @param string    $name
     * @param string    $value
     */
    protected function optionalWriteElement(XMLWriter $XMLWriter, $name, $value)
    {
        if ($value) {
            $XMLWriter->writeElement($name, $value);
        }
    }

    /**
     * Get last modification time.
     *
     * @return null|string
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }

    /**
     * Set last modification time.
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

    /**
     * Get change frequency.
     *
     * @return null|string
     */
    public function getChangeFreq()
    {
        return $this->changeFreq;
    }

    /**
     * Set change frequency.
     *
     * @param string $changeFreq
     *
     * @return $this
     */
    public function setChangeFreq($changeFreq)
    {
        $this->changeFreq = $changeFreq;

        return $this;
    }

    /**
     * Url priority.
     *
     * @return null|string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set priority.
     *
     * @param string $priority
     *
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Add a new sub element.
     *
     * @param mixed $subElement
     *
     * @return $this
     */
    public function addSubElement($subElement)
    {
        $this->subElements[] = $subElement;

        return $this;
    }
}
