<?php

namespace Sitemap\Writers\XML;

use Sitemap\Sitemap\BasicSitemap;

class Sitemap extends \Sitemap\Writers\XML
{
    protected $sitemap;

    public function __construct(BasicSitemap $sitemap)
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
