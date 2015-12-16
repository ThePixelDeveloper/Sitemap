<?php

namespace spec\Thepixeldeveloper\Sitemap\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;

class SitemapIndexSpec extends ObjectBehavior
{
    function let(\XMLWriter $writer)
    {
        $this->beConstructedWith($writer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Generator\SitemapIndex');
    }

    function it_should_generate_the_right_sitemap_index_attributes(SitemapIndex $sitemapIndex, \XMLWriter $writer)
    {
        $sitemapIndex->getSitemaps()->willReturn([]);

        $writer->startElement('sitemapindex')->shouldBeCalled();
        $writer->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')->shouldBeCalled();
        $writer->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd')->shouldBeCalled();
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9')->shouldBeCalled();
        $writer->endElement()->shouldBeCalled();

        $this->generate($sitemapIndex);
    }
}
