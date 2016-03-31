<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

use Thepixeldeveloper\Sitemap\AppendAttributeInterface;
use Thepixeldeveloper\Sitemap\OutputInterface;
use XMLWriter;

/**
 * Class Link
 *
 * @package Thepixeldeveloper\Sitemap\Subelements
 */
class Link implements OutputInterface, AppendAttributeInterface
{
    /**
     * @var string
     */
    protected $hreflang;

    /**
     * @var string
     */
    protected $href;

    /**
     * Image constructor
     *
     * @param $loc
     */
    public function __construct($hreflang, $href)
    {
        $this->hreflang = $hreflang;
        $this->href = $href;
    }

    /**
     * @param XMLWriter $XMLWriter
     */
    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('xhtml:link');
        $XMLWriter->writeAttribute('rel', 'alternate');
        $XMLWriter->writeAttribute('hreflang', $this->hreflang);
        $XMLWriter->writeAttribute('href', $this->href);
        $XMLWriter->endElement();
    }

    /**
     * @param XMLWriter $XMLWriter
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->writeAttribute('xmlns:xhtml', 'http://www.w3.org/1999/xhtml');
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @return string
     */
    public function getHreflang()
    {
        return $this->hreflang;
    }
}
