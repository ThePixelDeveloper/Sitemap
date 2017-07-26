<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

use XMLWriter;
use Thepixeldeveloper\Sitemap\OutputInterface;
use Thepixeldeveloper\Sitemap\AppendAttributeInterface;

/**
 * Class Link
 *
 * @package Thepixeldeveloper\Sitemap\Subelements
 */
class Link implements OutputInterface, AppendAttributeInterface
{
    /**
     * Language code for the page.
     *
     * @var string
     */
    protected $hrefLang;

    /**
     * Location of the translated page.
     *
     * @var string
     */
    protected $href;

    /**
     * Link constructor.
     *
     * @param string $hrefLang
     * @param string $href
     */
    public function __construct($hrefLang, $href)
    {
        $this->hrefLang = $hrefLang;
        $this->href = $href;
    }

    /**
     * {@inheritdoc}
     */
    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('xhtml:link');
        $XMLWriter->writeAttribute('rel', 'alternate');
        $XMLWriter->writeAttribute('hreflang', $this->hrefLang);
        $XMLWriter->writeAttribute('href', $this->href);
        $XMLWriter->endElement();
    }

    /**
     * {@inheritdoc}
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->writeAttribute('xmlns:xhtml', 'https://www.w3.org/1999/xhtml');
    }

    /**
     * Location of the translated page.
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Language code for the page.
     * 
     * @return string
     */
    public function getHrefLang()
    {
        return $this->hrefLang;
    }
}
