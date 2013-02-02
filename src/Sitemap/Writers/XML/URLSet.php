<?php

namespace Sitemap\Writers\XML;

use Sitemap\Writers\XML;

class URLSet extends XML
{
    private $urlset;

    public function __construct(\Sitemap\URLSet $urlset)
    {
        $this->index = $urlset;
    }

    public function output()
    {
        $writer = $this->writer();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElementNs(null, 'urlset', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->index->getSitemaps() as $sitemap) {
            $writer->startElement('url');
            $writer->writeRaw(new \Sitemap\Writers\XML\Sitemap\Basic($sitemap));
            $writer->endElement();
        }

        $writer->endElement();

        return $writer->flush();
    }
}