<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

/**
 * Class SitemapIndex
 *
 * @package Thepixeldeveloper\Sitemap
 */
class SitemapIndex implements OutputInterface
{
    /**
     * Array of Sitemap entries.
     *
     * @var OutputInterface[]
     */
    protected $sitemaps = [];

    /**
     * Add a new Sitemap object to the collection.
     *
     * @param OutputInterface $sitemap
     *
     * @return $this
     */
    public function addSitemap(OutputInterface $sitemap)
    {
        $this->sitemaps[] = $sitemap;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('sitemapindex');
        $XMLWriter->writeAttribute('xmlns:xsi', 'https://www.w3.org/2001/XMLSchema-instance');

        $XMLWriter->writeAttribute(
            'xsi:schemaLocation',
            'http://www.sitemaps.org/schemas/sitemap/0.9 ' .
            'http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd'
        );

        $XMLWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->getSitemaps() as $sitemap) {
            $sitemap->generateXML($XMLWriter);
        }

        $XMLWriter->endElement();
    }

    /**
     * Get an array of Sitemap objects.
     *
     * @return OutputInterface[]
     */
    public function getSitemaps()
    {
        return $this->sitemaps;
    }
}
