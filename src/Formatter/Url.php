<?php

namespace Thepixeldeveloper\Sitemap\Formatter;

class Url
{
    /**
     * @var \XMLWriter
     */
    protected $xmlWriter;

    /**
     * Url constructor.
     *
     * @param \XMLWriter $xmlWriter
     */
    public function __construct(\XMLWriter $xmlWriter)
    {
        $this->xmlWriter = $xmlWriter;
    }

    public function generate(\Thepixeldeveloper\Sitemap\Url $url)
    {
        $this->xmlWriter->startElement('url');
        $this->xmlWriter->writeElement('loc', $url->getLoc());

        $this->writeElement('lastmod', $url->getLastMod());
        $this->writeElement('changefreq', $url->getChangeFreq());
        $this->writeElement('priority', $url->getPriority());

        $this->xmlWriter->endElement();
    }

    protected function writeElement($name, $value)
    {
        if ($value) {
            $this->xmlWriter->writeElement($name, $value);
        }

        return $this;
    }
}
