<?php

namespace Thepixeldeveloper\Sitemap;

class SitemapIndex
{
    protected $sitemaps = [];

    /**
     * @return mixed
     */
    public function getSitemaps()
    {
        return $this->sitemaps;
    }

    /**
     * @param Sitemap $sitemap
     *
     * @return $this
     */
    public function addSitemap(Sitemap $sitemap)
    {
        $this->sitemaps[] = $sitemap;

        return $this;
    }
}
