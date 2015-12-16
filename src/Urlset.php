<?php

namespace Thepixeldeveloper\Sitemap;

class Urlset implements OutputInterface
{
    protected $urls = [];

    /**
     * @return mixed
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @param Url $url
     *
     * @return $this
     */
    public function addUrl(Url $url)
    {
        $this->urls[] = $url;

        return $this;
    }

    public function generateXML(\XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('urlset');

        $XMLWriter->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $XMLWriter->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');
        $XMLWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->getUrls() as $url) {
            $url->generateXML($XMLWriter);
        }

        $XMLWriter->endElement();
    }
}
