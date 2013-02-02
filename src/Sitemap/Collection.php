<?php

namespace Sitemap;

use Sitemap\Sitemap\SitemapEntry;
use XMLWriter;

class Collection
{
    private $sitemaps = array();

    public function addSitemap(SitemapEntry $sitemap)
    {
        $this->sitemaps[serialize($sitemap)] = $sitemap;
    }

    public function output()
    {
        $writer = new XMLWriter;
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElementNs(null, $this->collectionName(), 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->sitemaps as $sitemap) {
            $writer->startElement($this->entryWrapper());
            $writer->writeRaw($sitemap->output());
            $writer->endElement();
        }

        $writer->endElement();
        return $writer->flush();
    }
}
