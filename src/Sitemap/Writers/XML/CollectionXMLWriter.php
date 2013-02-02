<?php

namespace Sitemap\Writers\XML;

use Sitemap\Writers\XML;
use Sitemap\Collection;

abstract class CollectionXMLWriter extends XML
{
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    abstract protected function rootElement();

    abstract protected function sitemapWrapperElement();

    public function output()
    {
        $writer = $this->writer();
        $writer->startDocument('1.0', 'UTF-8');
        $this->rootElement();

        foreach ($this->collection->getSitemaps() as $sitemap) {
            $this->sitemapWrapperElement();
            $writer->writeRaw(new \Sitemap\Writers\XML\Sitemap\Basic($sitemap));
            $writer->endElement();
        }

        $writer->endElement();

        return $writer->flush();
    }
}