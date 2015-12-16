<?php

namespace Thepixeldeveloper\Sitemap\Generator;

class Urlset
{
    /**
     * @var \XMLWriter
     */
    protected $xmlWriter;

    /**
     * @var Url
     */
    protected $urlGenerator;

    /**
     * Urlset constructor.
     *
     * @param \XMLWriter $xmlWriter
     * @param Url        $urlGenerator
     */
    public function __construct(\XMLWriter $xmlWriter, Url $urlGenerator)
    {
        $this->xmlWriter = $xmlWriter;
        $this->urlGenerator = $urlGenerator;
    }

    public function generate(\Thepixeldeveloper\Sitemap\Urlset $urlset)
    {
        $this->xmlWriter->startElement('urlset');

        $this->xmlWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $this->xmlWriter->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');
        $this->xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urlset->getUrls() as $url) {
            $this->urlGenerator->generate($url);
        }

        $this->xmlWriter->endElement();
    }
}
