<?php

namespace Thepixeldeveloper\Sitemap\Generator;

class SitemapIndex
{
    /**
     * @var \XMLWriter
     */
    protected $xmlWriter;

    /**
     * @var Sitemap
     */
    protected $sitemapGenerator;

    /**
     * SitemapIndex constructor.
     *
     * @param \XMLWriter $xmlWriter
     */
    public function __construct(\XMLWriter $xmlWriter, Sitemap $sitemapGenerator)
    {
        $this->xmlWriter = $xmlWriter;
        $this->sitemapGenerator = $sitemapGenerator;
    }

    public function generate(\Thepixeldeveloper\Sitemap\SitemapIndex $sitemapIndex)
    {
        $this->xmlWriter->startElement('sitemapindex');
        $this->xmlWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $this->xmlWriter->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');
        $this->xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($sitemapIndex->getSitemaps() as $sitemap) {
            $this->sitemapGenerator->generate($sitemap);
        }

        $this->xmlWriter->endElement();
    }
}
