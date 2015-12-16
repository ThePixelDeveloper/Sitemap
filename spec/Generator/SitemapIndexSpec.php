<?php

namespace spec\Thepixeldeveloper\Sitemap\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;

class SitemapIndexSpec extends ObjectBehavior
{
    function let(\XMLWriter $writer, \Thepixeldeveloper\Sitemap\Generator\Sitemap $sitemapGenerator)
    {
        $this->beConstructedWith($writer, $sitemapGenerator);
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

    function it_should_generate_n_sitemaps_for_the_amount_of_sitemaps_in_the_collection(
        SitemapIndex $sitemapIndex,
        \XMLWriter $writer,
        \Thepixeldeveloper\Sitemap\Generator\Sitemap $sitemapGenerator,
        Sitemap $sitemap
        )
    {
        $sitemapGenerator->generate($sitemap)->shouldBeCalled();

        $sitemapIndex->getSitemaps()->willReturn([$sitemap]);

        $writer->startElement('sitemapindex')->shouldBeCalled();
        $writer->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')->shouldBeCalled();
        $writer->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd')->shouldBeCalled();
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9')->shouldBeCalled();
        $writer->endElement()->shouldBeCalled();

        $this->generate($sitemapIndex);
    }
}
