<?php declare(strict_types=1);

namespace Tests\Thepixeldeveloper\Sitemap;

use PHPUnit\Framework\TestCase;
use Thepixeldeveloper\Sitemap\Drivers\XmlWriterDriver;
use Thepixeldeveloper\Sitemap\Extensions\Image;
use Thepixeldeveloper\Sitemap\Extensions\Link;
use Thepixeldeveloper\Sitemap\Extensions\Mobile;
use Thepixeldeveloper\Sitemap\Extensions\News;
use Thepixeldeveloper\Sitemap\Extensions\Video;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

class CompleteTest extends TestCase
{
    public function testCompleteSitemap()
    {
        $extensions = [
            new Image('http://example.com'),
            new Link('en-GB', 'http://example.com'),
            new Mobile(),
            new News(),
            new Video('http://example.com/thumbnail', 'title', 'description'),
        ];

        $urlset = new Urlset();

        foreach ($extensions as $extension) {
            $url = new Url('http://example.com');
            $url->addExtension($extension);
            $urlset->add($url);
        }

        $driver = new XmlWriterDriver();
        $urlset->accept($driver);

        $expected = <<<XML
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    <url>
        <loc>http://example.com</loc>
        <image:image>
            <image:loc>http://example.com</image:loc>
        </image:image>
    </url>
    <url>
        <loc>http://example.com</loc>
        <xhtml:link rel="alternate" hreflang="en-GB" href="http://example.com"/>
    </url>
    <url>
        <loc>http://example.com</loc>
        <mobile:mobile/>
    </url>
    <url>
        <loc>http://example.com</loc>
        <news:news>
            <news:publication/>
        </news:news>
    </url>
    <url>
        <loc>http://example.com</loc>
        <video:video>
            <video:thumbnail_loc>http://example.com/thumbnail</video:thumbnail_loc>
            <video:title>title</video:title>
            <video:description>description</video:description>
        </video:video>
    </url>
</urlset>
XML;

        $this->assertXmlStringEqualsXmlString($expected, $driver->output());
    }

    public function testCompleteIndex()
    {
        $sitemap = new Sitemap('http://example.com');

        $sitemapIndex = new SitemapIndex();
        $sitemapIndex->add($sitemap);

        $driver = new XmlWriterDriver();
        $sitemapIndex->accept($driver);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
              xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>http://example.com</loc>
    </sitemap>
</sitemapindex>
XML;

        $this->assertXmlStringEqualsXmlString($expected, $driver->output());
    }
}
