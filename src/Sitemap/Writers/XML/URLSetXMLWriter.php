<?php

namespace Sitemap\Writers\XML;

class URLSetXMLWriter extends CollectionXMLWriter
{
    protected function rootElement()
    {
        $this->writer()->startElementNs(null, 'urlset', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    }

    protected function sitemapWrapperElement()
    {
        $this->writer()->startElement('url');
    }
}
