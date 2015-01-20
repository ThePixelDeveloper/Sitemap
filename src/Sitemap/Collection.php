<?php

namespace Sitemap;

class Collection
{
    private $sitemaps = array();

    private $formatter;

    public function addSitemap($sitemap)
    {
        $this->sitemaps[serialize($sitemap)] = $sitemap;
    }

    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function output()
    {
        return $this->formatter->render($this->sitemaps);
    }

    public function hasSitemaps()
    {
        return !empty($this->sitemaps);
    }
}
