<?php

namespace Tests\Thepixeldeveloper\Sitemap\Drivers;

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

class XmlWriterDriverTest extends TestCase
{
    public function testProcessingInstructions()
    {
        $driver = new XmlWriterDriver();
        $driver->addProcessingInstructions('xml-stylesheet', 'type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"');

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"?>
XML;

        $this->assertSame($expected, $driver->output());
    }

    public function testSitemapIndex()
    {
        $sitemapIndex = new SitemapIndex();

        $driver = new XmlWriterDriver();
        $driver->visitSitemapIndex($sitemapIndex);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd"/>
XML;
        $this->assertSame($expected, $driver->output());
    }

    public function testSitemap()
    {
        $date = new \DateTime();

        $sitemap = new Sitemap('https://example.com');
        $sitemap->setLastMod($date);

        $driver = new XmlWriterDriver();
        $driver->visitSitemap($sitemap);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemap><loc>https://example.com</loc><lastmod>{$date->format(DATE_W3C)}</lastmod></sitemap>
XML;

        $this->assertSame($expected, $driver->output());
    }

    public function testUrlset()
    {
        $urlset = new Urlset();

        $driver = new XmlWriterDriver();
        $driver->visitUrlset($urlset);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>
XML;
        $this->assertSame($expected, $driver->output());
    }

    public function testUrl()
    {
        $date = new \DateTime();

        $url = new Url('https://example.com');
        $url->setLastMod($date);

        $driver = new XmlWriterDriver();
        $driver->visitUrl($url);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<url><loc>https://example.com</loc><lastmod>{$date->format(DATE_W3C)}</lastmod></url>
XML;

        $this->assertSame($expected, $driver->output());
    }

    public function testImageExtension()
    {
        $image = new Image('https://example.com');
        $image->setTitle('Title');
        $image->setCaption('Captain');
        $image->setLicense('MIT');
        $image->setGeoLocation('Limerick, Ireland');

        $driver = new XmlWriterDriver();
        $driver->visitImageExtension($image);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<image:image><image:loc>https://example.com</image:loc><image:caption>Captain</image:caption><image:geo_location>Limerick, Ireland</image:geo_location><image:title>Title</image:title><image:license>MIT</image:license></image:image>
XML;

        $this->assertSame($expected, $driver->output());
    }

    public function testLinkExtension()
    {
        $image = new Link('en_GB', 'https://example.com');

        $driver = new XmlWriterDriver();
        $driver->visitLinkExtension($image);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<xhtml:link rel="alternate" hreflang="en_GB" href="https://example.com"/>
XML;

        $this->assertSame($expected, $driver->output());
    }

    public function testMobileExtension()
    {
        $mobile = new Mobile();

        $driver = new XmlWriterDriver();
        $driver->visitMobileExtension($mobile);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<mobile:mobile/>
XML;

        $this->assertSame($expected, $driver->output());
    }

    public function testNewsExtension()
    {
        $news = new News();
        $news->setPublicationName('Example Publisher');
        $news->setTitle('Example Title');
        $news->setPublicationLanguage('en');
        $news->setAccess('paid');
        $news->setKeywords('hello, world');
        $news->setPublicationDate(new \DateTime('2017-11-05T12:01:27+00:00'));

        $driver = new XmlWriterDriver();
        $driver->visitNewsExtension($news);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<news:news><news:publication><news:name>Example Publisher</news:name><news:language>en</news:language></news:publication><news:access>paid</news:access><news:publication_date>2017-11-05T12:01:27+00:00</news:publication_date><news:title>Example Title</news:title><news:keywords>hello, world</news:keywords></news:news>
XML;

        $this->assertSame($expected, $driver->output());
    }

    public function testVideoExtension()
    {
        $video = new Video('https://example.com', 'Title', 'Description');

        $driver = new XmlWriterDriver();
        $driver->visitVideoExtension($video);

        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<video:video><video:thumbnail_loc>https://example.com</video:thumbnail_loc><video:title>Title</video:title><video:description>Description</video:description></video:video>
XML;

        $this->assertSame($expected, $driver->output());
    }
}
