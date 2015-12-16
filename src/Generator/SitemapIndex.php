<?php

namespace Thepixeldeveloper\Sitemap\Generator;

class SitemapIndex
{
    /**
     * @var \XMLWriter
     */
    protected $xmlWriter;

    /**
     * SitemapIndex constructor.
     *
     * @param \XMLWriter $xmlWriter
     */
    public function __construct(\XMLWriter $xmlWriter)
    {
        $this->xmlWriter = $xmlWriter;
    }

    public function generate(\Thepixeldeveloper\Sitemap\SitemapIndex $sitemapIndex)
    {
        $this->xmlWriter->startElement('sitemapindex');

        $this->xmlWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $this->xmlWriter->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');
        $this->xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $sitemapFormatter = new Sitemap($this->xmlWriter);

        foreach ($sitemapIndex->getSitemaps() as $sitemap) {
            $sitemapFormatter->format($sitemap);
        }

        $this->xmlWriter->endElement();
    }
}
