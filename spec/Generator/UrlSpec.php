<?php

namespace spec\Thepixeldeveloper\Sitemap\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Url;

class UrlSpec extends ObjectBehavior
{
    function let(\XMLWriter $writer)
    {
        $this->beConstructedWith($writer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Generator\Url');
    }

    function it_should_return_xml_for_a_given_object(Url $url, \XMLWriter $writer)
    {
        $writer->startElement('url')->shouldBeCalled();
        $writer->writeElement('loc', 'http://www.example.com/')->shouldBeCalled();
        $writer->writeElement('lastmod', '2005-01-01')->shouldBeCalled();
        $writer->writeElement('changefreq', 'monthly')->shouldBeCalled();
        $writer->writeElement('priority', '0.8')->shouldBeCalled();
        $writer->endElement()->shouldBeCalled();

        $url->getLoc()->willReturn('http://www.example.com/');
        $url->getLastMod()->willReturn('2005-01-01');
        $url->getChangeFreq()->willReturn('monthly');
        $url->getPriority()->willReturn('0.8');

        $this->generate($url);
    }

    function it_should_return_optional_elements_when_not_defined(Url $url, \XMLWriter $writer)
    {
        $writer->startElement('url')->shouldBeCalled();
        $writer->writeElement('loc', 'http://www.example.com/')->shouldBeCalled();
        $writer->endElement()->shouldBeCalled();

        $url->getLoc()->willReturn('http://www.example.com/');
        $url->getLastMod()->willReturn(null);
        $url->getChangeFreq()->willReturn(null);
        $url->getPriority()->willReturn(null);

        $this->generate($url);
    }
}
