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
     * Change frequency of the location.
     *
     * @var string
     */
    protected $changeFreq;

    /**
     * Priority of page importance.
     *
     * @var string
     */
    protected $priority;

    /**
     * Array of sub-elements.
     *
     * @var OutputInterface[]
     */
    protected $subelements = [];

    /**
     * Sub-elements that append to the collection attributes.
     *
     * @var AppendAttributeInterface[]
     */
    protected $subelementsThatAppend = [];

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
        foreach ($this->getSubelementsThatAppend() as $subelement) {
            $subelement->appendAttributeToCollectionXML($XMLWriter);
        }

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
     * Array of sub-elements.
     *
     * @return OutputInterface[]
     */
    public function getSubelements()
    {
        return $this->subelements;
    }

    /**
     * Array of sub-elements that append to the collections attributes.
     *
     * @return AppendAttributeInterface[]
     */
    public function getSubelementsThatAppend()
    {
        return $this->subelementsThatAppend;
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
     * @param OutputInterface $subElement
     *
     * @return $this
     */
    public function addSubElement(OutputInterface $subElement)
    {
        $this->subelements[] = $subElement;

        if ($this->isSubelementGoingToAppend($subElement)) {
            $this->subelementsThatAppend[get_class($subElement)] = $subElement;
        }

        return $this;
    }

    /**
     * Checks if the sub-element is going to append collection attributes.
     *
     * @param OutputInterface $subelement
     *
     * @return boolean
     */
    protected function isSubelementGoingToAppend(OutputInterface $subelement)
    {
        if (!$subelement instanceof AppendAttributeInterface) {
            return false;
        }

        return !in_array(get_class($subelement), $this->subelementsThatAppend, false);
    }
}
