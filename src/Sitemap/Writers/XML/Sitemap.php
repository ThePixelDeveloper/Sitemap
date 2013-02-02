<?php

namespace Sitemap\Writers\XML;

class Sitemap extends \Sitemap\Writers\XML
{
    public function __construct(\Sitemap\Sitemap $sitemap)
    {
        $this->sitemap = $sitemap;
    }

    public function output()
    {
        $writer = $this->writer();
        $writer->writeElement('loc', $this->sitemap->getLocation());
        $writer->writeElement('lastmod', $this->sitemap->getLastMod());
        return $writer->flush();
    }
}
