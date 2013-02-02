<?php

namespace Sitemap\Writers\XML;

class Sitemap extends \Sitemap\Writers\XML
{
    public function output()
    {
        $writer = $this->writer();
        $writer->openMemory();
        $writer->writeElement('loc', $this->container->getLocation());
        $writer->writeElement('lastmod', $this->container->getLastMod());
        return $writer->outputMemory();
    }
}
