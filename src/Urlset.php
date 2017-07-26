<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

/**
 * Class Urlset
 *
 * @package Thepixeldeveloper\Sitemap
 */
class Urlset implements OutputInterface
{
    /**
     * Array of URL objects.
     *
     * @var OutputInterface[]
     */
    protected $urls = [];

    /**
     * Sub-elements that have been appended to the collection attributes.
     *
     * @var AppendAttributeInterface[]
     */
    protected $appendedSubelements = [];

    /**
     * Add a new URL object.
     *
     * @param OutputInterface $url
     *
     * @return $this
     */
    public function addUrl(OutputInterface $url)
    {
        $this->urls[] = $url;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('urlset');

        $XMLWriter->writeAttribute('xmlns:xsi', 'https://www.w3.org/2001/XMLSchema-instance');

        $XMLWriter->writeAttribute('xsi:schemaLocation',
            'https://www.sitemaps.org/schemas/sitemap/0.9 ' .
            'https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');

        $XMLWriter->writeAttribute('xmlns', 'https://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->getUrls() as $url) {
            foreach ($url->getSubelementsThatAppend() as $subelement) {
                $this->appendSubelementAttribute($XMLWriter, $subelement);
            }
        }

        foreach ($this->getUrls() as $url) {
            $url->generateXML($XMLWriter);
        }

        $XMLWriter->endElement();
    }

    /**
     * Get array of URL objects.
     * 
     * @return OutputInterface[]
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * Appends the sub-element to the collection attributes if it has yet to be visited.
     *
     * @param XMLWriter $XMLWriter
     * @param OutputInterface $subelement
     *
     * @return boolean
     */
    public function appendSubelementAttribute(XMLWriter $XMLWriter, OutputInterface $subelement)
    {
        if (array_key_exists(get_class($subelement), $this->appendedSubelements)) {
            return false;
        }

        $subelement->appendAttributeToCollectionXML($XMLWriter);
        $this->appendedSubelements[get_class($subelement)] = $subelement;

        return true;
    }
}
