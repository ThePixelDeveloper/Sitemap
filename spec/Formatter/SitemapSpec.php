<?php

namespace spec\Thepixeldeveloper\Sitemap\Formatter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Sitemap;

class SitemapSpec extends ObjectBehavior
{
    function let(\XMLWriter $writer)
    {
        $this->beConstructedWith($writer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Formatter\Sitemap');
    }

    function it_should_return_xml_for_a_given_object(Sitemap $sitemap, \XMLWriter $writer)
    {
        $writer->startElement('sitemap')->shouldBeCalled();
        $writer->writeElement('loc', 'http://www.example.com/sitemap1.xml.gz')->shouldBeCalled();
        $writer->writeElement('lastmod', '2004-10-01T18:23:17+00:00')->shouldBeCalled();
        $writer->endElement()->shouldBeCalled();

        $sitemap->getLoc()->willReturn('http://www.example.com/sitemap1.xml.gz');
        $sitemap->getLastMod()->willReturn('2004-10-01T18:23:17+00:00');

        $this->generate($sitemap);
    }

    function it_should_return_optional_elements_when_not_defined(Sitemap $sitemap, \XMLWriter $writer)
    {
        $writer->startElement('sitemap')->shouldBeCalled();
        $writer->writeElement('loc', 'http://www.example.com/sitemap1.xml.gz')->shouldBeCalled();
        $writer->endElement()->shouldBeCalled();

        $sitemap->getLoc()->willReturn('http://www.example.com/sitemap1.xml.gz');
        $sitemap->getLastMod()->willReturn(null);

        $this->generate($sitemap);
    }
}


