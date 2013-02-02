<?php

namespace Sitemap;

class URLSet
{
    private $sitemaps = array();

    public function addSitemap(Sitemap $sitemap)
    {
        $this->sitemaps[spl_object_hash($sitemap)] = $sitemap;
    }

    public function getSitemaps()
    {
        return $this->sitemaps;
    }
}
