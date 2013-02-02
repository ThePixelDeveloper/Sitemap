<?php

namespace Sitemap\Writers\XML;

use Sitemap\Writers\XML;

class Index extends XML
{
    private $index;

    public function __construct(\Sitemap\Index $index)
    {
        $this->index = $index;
    }

    public function output()
    {
        $writer = $this->writer();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElementNs(null, 'sitemapindex', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->index->getSitemaps() as $sitemap) {
            $writer->startElement('sitemap');
            $writer->writeRaw(new \Sitemap\Writers\XML\Sitemap($sitemap));
            $writer->endElement();
        }

        $writer->endElement();

        return $writer->flush();
    }
}