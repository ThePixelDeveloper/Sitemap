<?php

namespace Thepixeldeveloper\Sitemap\Generator;

class Urlset
{
    /**
     * @var \XMLWriter
     */
    protected $xmlWriter;

    /**
     * Urlset constructor.
     *
     * @param \XMLWriter $xmlWriter
     */
    public function __construct(\XMLWriter $xmlWriter)
    {
        $this->xmlWriter = $xmlWriter;
    }

    public function generate(\Thepixeldeveloper\Sitemap\Urlset $urlset)
    {
        $this->xmlWriter->startElement('urlset');

        $this->xmlWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $this->xmlWriter->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');
        $this->xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $urlFormatter = new Url($this->xmlWriter);

        foreach ($urlset->getUrls() as $url) {
            $urlFormatter->format($url);
        }

        $this->xmlWriter->endElement();
    }
}
