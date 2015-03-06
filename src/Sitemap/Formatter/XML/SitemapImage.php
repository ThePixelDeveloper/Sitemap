<?php

namespace Sitemap\Formatter\XML;

use XMLWriter;

class SitemapImage extends \Sitemap\Formatter\XML
{
    protected function collectionName()
    {
        return 'urlset';
    }

    protected function entryWrapper()
    {
        return 'url';
    }

    public function render($sitemaps)
    {
        $writer = new XMLWriter;
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement($this->collectionName());
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $writer->writeAttributeNs('xmlns', 'image', null, 'http://www.google.com/schemas/sitemap-image/1.1');

        foreach ($sitemaps as $sitemap) {
            $writer->startElement($this->entryWrapper());
            $writer->writeRaw($this->writeElement('loc', $sitemap->getLocation()));

            foreach ($sitemap->getImages() as $image) {
                $writer->startElement('image:image');
                $writer->writeRaw($this->writeElement('image:loc', $image->getLocation()));
                $writer->writeRaw($this->writeElement('image:caption', $image->getCaption()));
                $writer->writeRaw($this->writeElement('image:geo_location', $image->getGeoLocation()));
                $writer->writeRaw($this->writeElement('image:title', $image->getTitle()));
                $writer->writeRaw($this->writeElement('image:license', $image->getLicense()));
                $writer->endElement();
            }

            $writer->endElement();
        }

        $writer->endElement();
        return $writer->flush();
    }
}