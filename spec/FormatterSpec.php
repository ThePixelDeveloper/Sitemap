<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;

class FormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Formatter');
    }

    function it_should_format_a_sitemapindex_with_n_sitemaps(SitemapIndex $sitemapIndex, Sitemap $sitemap)
    {
        $sitemap->getLoc()->willReturn('http://www.example.com/sitemap1.xml.gz');
        $sitemap->getLastMod()->willReturn(null);

        $sitemapIndex->getSitemaps()->willReturn([$sitemap, $sitemap]);

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

        $this->format($sitemapIndex)->shouldReturn($xml);
    }

    function it_should_format_a_sitemapindex_with_n_sitemaps_with_no_indentation(SitemapIndex $sitemapIndex, Sitemap $sitemap)
    {
        $this->setIndented(false);

        $sitemap->getLoc()->willReturn('http://www.example.com/sitemap1.xml.gz');
        $sitemap->getLastMod()->willReturn(null);

        $sitemapIndex->getSitemaps()->willReturn([$sitemap, $sitemap]);

        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><sitemap><loc>http://www.example.com/sitemap1.xml.gz</loc></sitemap><sitemap><loc>http://www.example.com/sitemap1.xml.gz</loc></sitemap></sitemapindex>
XML;

        $this->format($sitemapIndex)->shouldReturn($xml);
    }
}
