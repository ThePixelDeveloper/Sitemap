<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;
use Thepixeldeveloper\Sitemap\Subelements\Image;
use Thepixeldeveloper\Sitemap\Subelements\Link;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

class OutputSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Output');
    }

    function it_should_format_a_sitemapindex_with_n_sitemaps()
    {
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>http://www.example.com/sitemap1.xml.gz</loc>
    </sitemap>
    <sitemap>
        <loc>http://www.example.com/sitemap1.xml.gz</loc>
    </sitemap>
</sitemapindex>
XML;

        $sitemapIndex = new SitemapIndex();
        $sitemapIndex->addSitemap(new Sitemap('http://www.example.com/sitemap1.xml.gz'));
        $sitemapIndex->addSitemap(new Sitemap('http://www.example.com/sitemap1.xml.gz'));

        $this->getOutput($sitemapIndex)->shouldReturn($xml);
    }

    function it_should_generate_a_sitemap_of_images()
    {
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>http://www.example.com/1</loc>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image2</image:loc>
            <image:caption>Test Caption</image:caption>
            <image:geo_location>Limerick, Ireland</image:geo_location>
            <image:title>Test Title</image:title>
            <image:license>http://www.license.com</image:license>
        </image:image>
    </url>
    <url>
        <loc>http://www.example.com/2</loc>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image2</image:loc>
            <image:caption>Test Caption</image:caption>
            <image:geo_location>Limerick, Ireland</image:geo_location>
            <image:title>Test Title</image:title>
            <image:license>http://www.license.com</image:license>
        </image:image>
    </url>
</urlset>
XML;

        $urlset = new Urlset();

        $image2 = new Image('https://s3.amazonaws.com/path/to/image2');
        $image2->setCaption('Test Caption');
        $image2->setGeoLocation('Limerick, Ireland');
        $image2->setTitle('Test Title');
        $image2->setLicense('http://www.license.com');

        $image = new Image('https://s3.amazonaws.com/path/to/image');

        $imageUrl = new Url('http://www.example.com/1');
        $imageUrl->addSubElement($image);
        $imageUrl->addSubElement($image2);

        $imageUrl2 = new Url('http://www.example.com/2');
        $imageUrl2->addSubElement($image);
        $imageUrl2->addSubElement($image2);

        $urlset->addUrl($imageUrl);
        $urlset->addUrl($imageUrl2);

        $this->getOutput($urlset)->shouldReturn($xml);
    }

    function it_should_generate_a_sitemap_with_links()
    {
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <url>
        <loc>http://www.example.com/english/</loc>
        <xhtml:link rel="alternate" hreflang="de" href="http://www.example.com/deutsch/"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="http://www.example.com/schweiz-deutsch/"/>
        <xhtml:link rel="alternate" hreflang="en" href="http://www.example.com/english/"/>
    </url>
    <url>
        <loc>http://www.example.com/deutsch/</loc>
        <xhtml:link rel="alternate" hreflang="en" href="http://www.example.com/english/"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="http://www.example.com/schweiz-deutsch/"/>
        <xhtml:link rel="alternate" hreflang="de" href="http://www.example.com/deutsch/"/>
    </url>
    <url>
        <loc>http://www.example.com/schweiz-deutsch/</loc>
        <xhtml:link rel="alternate" hreflang="de" href="http://www.example.com/deutsch/"/>
        <xhtml:link rel="alternate" hreflang="en" href="http://www.example.com/english/"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="http://www.example.com/schweiz-deutsch/"/>
    </url>
</urlset>
XML;
        $urlset = new Urlset();
        $url = new Url('http://www.example.com/english/');
        $url->addSubElement(new Link('de', 'http://www.example.com/deutsch/'));
        $url->addSubElement(new Link('de-ch', 'http://www.example.com/schweiz-deutsch/'));
        $url->addSubElement(new Link('en', 'http://www.example.com/english/'));
        $urlset->addUrl($url);

        $url = new Url('http://www.example.com/deutsch/');
        $url->addSubElement(new Link('en', 'http://www.example.com/english/'));
        $url->addSubElement(new Link('de-ch', 'http://www.example.com/schweiz-deutsch/'));
        $url->addSubElement(new Link('de', 'http://www.example.com/deutsch/'));
        $urlset->addUrl($url);

        $url = new Url('http://www.example.com/schweiz-deutsch/');
        $url->addSubElement(new Link('de', 'http://www.example.com/deutsch/'));
        $url->addSubElement(new Link('en', 'http://www.example.com/english/'));
        $url->addSubElement(new Link('de-ch', 'http://www.example.com/schweiz-deutsch/'));
        $urlset->addUrl($url);

        $this->getOutput($urlset)->shouldReturn($xml);
    }

    function it_should_write_processing_instructions()
    {
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <url>
        <loc>http://www.example.com/english/</loc>
        <xhtml:link rel="alternate" hreflang="de" href="http://www.example.com/deutsch/"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="http://www.example.com/schweiz-deutsch/"/>
        <xhtml:link rel="alternate" hreflang="en" href="http://www.example.com/english/"/>
    </url>
</urlset>
XML;

        $urlset = new Urlset();
        $url = new Url('http://www.example.com/english/');
        $url->addSubElement(new Link('de', 'http://www.example.com/deutsch/'));
        $url->addSubElement(new Link('de-ch', 'http://www.example.com/schweiz-deutsch/'));
        $url->addSubElement(new Link('en', 'http://www.example.com/english/'));
        $urlset->addUrl($url);

        $this->addProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"');
        $this->getOutput($urlset)->shouldReturn($xml);

    }
}
