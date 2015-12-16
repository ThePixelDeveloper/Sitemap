<?php

namespace spec\Thepixeldeveloper\Sitemap\Formatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Urlset;

class UrlsetSpec extends ObjectBehavior
{
    function let(\XMLWriter $writer)
    {
        $this->beConstructedWith($writer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Formatter\Urlset');
    }

    function it_should_generate_the_right_sitemap_index_attributes(Urlset $urlset, \XMLWriter $writer)
    {
        $urlset->getUrls()->willReturn([]);

        $writer->startElement('urlset')->shouldBeCalled();
        $writer->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')->shouldBeCalled();
        $writer->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd')->shouldBeCalled();
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9')->shouldBeCalled();
        $writer->endElement()->shouldBeCalled();

        $this->generate($urlset);
    }
}
