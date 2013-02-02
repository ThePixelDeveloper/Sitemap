<?php

namespace Sitemap\Writers\XML;

class Sitemap extends \Sitemap\Writers\XML
{
    protected $sitemap;

    public function __construct(\Sitemap\Sitemap $sitemap)
    {
        $this->sitemap = $sitemap;
    }

    public function output()
    {
        $writer = $this->writer();
        $this->writeElementIfNotNull('loc', $this->sitemap->getLocation());
        $this->writeElementIfNotNull('lastmod', $this->sitemap->getLastMod());
        return $writer->flush();
    }
}
