<?php

namespace Sitemap\Writers\XML\Sitemap;

use Sitemap\Sitemap\BasicSitemap;

class Basic extends \Sitemap\Writers\XML
{
    public function __construct(BasicSitemap $sitemap)
    {
        $this->sitemap = $sitemap;
    }

    public function output()
    {
        $writer = $this->writer();
        $this->writeElementIfNotNull('loc', $this->sitemap->getLocation());
        $this->writeElementIfNotNull('lastmod', $this->sitemap->getLastMod());
        $this->writeElementIfNotNull('changefreq', $this->sitemap->getChangeFreq());
        $this->writeElementIfNotNull('priority', $this->sitemap->getPriority());
        return $writer->flush();
    }
}