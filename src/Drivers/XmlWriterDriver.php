<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Drivers;

use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;
use XMLWriter;

class XmlWriterDriver implements DriverInterface
{
    /**
     * @var XMLWriter
     */
    private $writer;

    /**
     * XmlWriterDriver constructor.
     */
    public function __construct()
    {
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');

        $this->writer = $writer;
    }

    public function visitSitemapIndex(SitemapIndex $sitemapIndex)
    {
        $this->writer->startElement('sitemapindex');
        $this->writer->writeAttribute('xmlns:xsi', 'https://www.w3.org/2001/XMLSchema-instance');

        $this->writer->writeAttribute(
            'xsi:schemaLocation',
            'http://www.sitemaps.org/schemas/sitemap/0.9 ' .
            'https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd'
        );
    }

    public function visitSitemap(Sitemap $sitemap)
    {
        $this->writer->startElement('sitemap');
        $this->writer->writeElement('loc', $sitemap->getLoc());

        if ($lastMod = $sitemap->getLastMod()) {
            $this->writer->writeElement('lastmod', $lastMod->format(DATE_W3C));
        }

        $this->writer->endElement();
    }

    public function output(): string
    {
        return $this->writer->flush();
    }
}
