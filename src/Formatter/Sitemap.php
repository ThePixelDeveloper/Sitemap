<?php

namespace Thepixeldeveloper\Sitemap\Formatter;

class Sitemap
{
    /**
     * @var \XMLWriter
     */
    protected $xmlWriter;

    /**
     * Sitemap constructor.
     *
     * @param \XMLWriter $xmlWriter
     */
    public function __construct(\XMLWriter $xmlWriter)
    {
        $this->xmlWriter = $xmlWriter;
    }

    public function generate(\Thepixeldeveloper\Sitemap\Sitemap $sitemap)
    {
        $this->xmlWriter->startElement('sitemap');
        $this->xmlWriter->writeElement('loc', $sitemap->getLoc());

        if ($lastMod = $sitemap->getLastMod()) {
            $this->xmlWriter->writeElement('lastmod', $lastMod);
        }

        $this->xmlWriter->endElement();
    }
}
