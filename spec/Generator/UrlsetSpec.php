<?php

namespace spec\Thepixeldeveloper\Sitemap\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

class UrlsetSpec extends ObjectBehavior
{
    function let(\XMLWriter $writer, \Thepixeldeveloper\Sitemap\Generator\Url $urlGenerator)
    {
        $this->beConstructedWith($writer, $urlGenerator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Generator\Urlset');
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

    function it_should_generate_n_urls_for_the_amount_of_urls_in_the_collection(
        Urlset $urlset,
        \XMLWriter $writer,
        \Thepixeldeveloper\Sitemap\Generator\Url $urlGenerator,
        Url $url
    )
    {
        $urlGenerator->generate($url)->shouldBeCalled();

        $urlset->getUrls()->willReturn([$url]);

        $writer->startElement('urlset')->shouldBeCalled();
        $writer->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')->shouldBeCalled();
        $writer->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd')->shouldBeCalled();
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9')->shouldBeCalled();
        $writer->endElement()->shouldBeCalled();

        $this->generate($urlset);
    }
}
