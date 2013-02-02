<?php

namespace Sitemap\Writers\XML;

class IndexXMLWriter extends CollectionXMLWriter
{
    protected function rootElement()
    {
        $this->writer()->startElementNs(null, 'sitemapindex', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    }

    protected function sitemapWrapperElement()
    {
        $this->writer()->startElement('sitemap');
    }
}
