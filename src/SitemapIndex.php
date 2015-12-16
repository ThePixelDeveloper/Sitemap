<?php

namespace Thepixeldeveloper\Sitemap;

class SitemapIndex implements OutputInterface
{
    /**
     * @var Sitemap[]
     */
    protected $sitemaps = [];

    /**
     * @param Sitemap $sitemap
     *
     * @return $this
     */
    public function addSitemap(Sitemap $sitemap)
    {
        $this->sitemaps[] = $sitemap;

        return $this;
    }

    /**
     * @param \XMLWriter $XMLWriter
     */
    public function generateXML(\XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('sitemapindex');
        $XMLWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $XMLWriter->writeAttribute('xsi:schemaLocation',
            'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');
        $XMLWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->getSitemaps() as $sitemap) {
            $sitemap->generateXML($XMLWriter);
        }

        $XMLWriter->endElement();
    }

    /**
     * @return Sitemap[]
     */
    public function getSitemaps()
    {
        return $this->sitemaps;
    }
}
