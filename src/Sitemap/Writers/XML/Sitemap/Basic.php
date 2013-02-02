<?php

namespace Sitemap\Writers\XML\Sitemap;

class Basic extends \Sitemap\Writers\XML\Sitemap
{
    protected $sitemap;

    public function __construct(\Sitemap\Sitemap\Basic $sitemap)
    {
        $this->sitemap = $sitemap;
    }

    public function output()
    {
        $writer = $this->writer();
        $writer->writeRaw(parent::output());
        $writer->writeElement('changefreq', $this->sitemap->getChangeFreq());
        $writer->writeElement('priority', $this->sitemap->getPriority());
        return $writer->flush();
    }
}