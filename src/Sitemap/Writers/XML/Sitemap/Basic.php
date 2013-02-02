<?php

namespace Sitemap\Writers\XML\Sitemap;

use Sitemap\Sitemap\BasicSitemap;

class Basic extends \Sitemap\Writers\XML\Sitemap
{
    public function __construct(BasicSitemap $sitemap)
    {
        $this->sitemap = $sitemap;
    }

    public function output()
    {
        $writer = $this->writer();
        $writer->writeRaw(parent::output());
        $this->writeElementIfNotNull('changefreq', $this->sitemap->getChangeFreq());
        $this->writeElementIfNotNull('priority', $this->sitemap->getPriority());
        return $writer->flush();
    }
}