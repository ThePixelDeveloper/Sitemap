<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Subelements\Image;
use Thepixeldeveloper\Sitemap\Subelements\Video;
use XMLWriter;

class UrlsetSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Urlset');
    }

    function it_should_return_an_empty_array_by_default()
    {
        $this->getUrls()->shouldReturn([]);
    }

    function it_should_return_the_urls_added(Url $url)
    {
        $this->addUrl($url)->shouldReturn($this);

        $this->getUrls()->shouldReturn([$url]);
    }

    function it_should_only_append_attributes_once_for_each_subelement_type(XMLWriter $xmlWriter, Url $url, Image $image, Video $video)
    {
        $xmlWriter->startElement('urlset')->shouldBeCalled();
        $xmlWriter->writeAttribute('xmlns:xsi', 'https://www.w3.org/2001/XMLSchema-instance')->shouldBeCalled();
        $xmlWriter->writeAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 ' . 'https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd')->shouldBeCalled();
        $xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9')->shouldBeCalled();

        $url->getSubelementsThatAppend()->willReturn([$image, $video]);
        $this->appendSubelementAttribute($xmlWriter, $image)->shouldReturn(true);
        $this->appendSubelementAttribute($xmlWriter, $image)->shouldReturn(false);
        $this->appendSubelementAttribute($xmlWriter, $video)->shouldReturn(true);
        $this->appendSubelementAttribute($xmlWriter, $video)->shouldReturn(false);

        $image->appendAttributeToCollectionXML($xmlWriter)->shouldBeCalled();
        $video->appendAttributeToCollectionXML($xmlWriter)->shouldBeCalled();
        $url->generateXML($xmlWriter)->shouldBeCalled();
        $xmlWriter->endElement()->shouldBeCalled();

        $this->addUrl($url);
        $this->generateXML($xmlWriter);
    }
}
