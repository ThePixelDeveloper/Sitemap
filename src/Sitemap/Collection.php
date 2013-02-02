<?php

namespace Sitemap;

use Sitemap\Sitemap\BasicSitemap;

class Collection
{
    private $sitemaps = array();

    public function addSitemap(BasicSitemap $sitemap)
    {
        $this->sitemaps[serialize($sitemap)] = $sitemap;
    }

    public function getSitemaps()
    {
        return $this->sitemaps;
    }
}
