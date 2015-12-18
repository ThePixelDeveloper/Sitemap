<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Subelements\Image;
use XMLWriter;

class UrlSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('http://www.example.com/');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Url');
    }

    function it_should_have_a_loc()
    {
        $this->getLoc()->shouldReturn('http://www.example.com/');
    }

    function it_should_have_a_last_mod()
    {
        $this->getLastMod()->shouldReturn(null);
    }

    function it_should_have_a_change_freq()
    {
        $this->getChangeFreq()->shouldReturn(null);
    }

    function it_should_have_a_priority()
    {
        $this->getPriority()->shouldReturn(null);
    }

    function it_should_only_append_attributes_once_for_each_subelement_type(XMLWriter $xmlWriter, Image $image)
    {
        $xmlWriter->startElement('url')->shouldBeCalled();
        $xmlWriter->writeElement('loc', 'http://www.example.com/')->shouldBeCalled();
        $xmlWriter->endElement()->shouldBeCalled();

        $this->addSubElement($image);
        $this->addSubElement($image);

        $image->appendAttributeToCollectionXML($xmlWriter)->shouldBeCalled();
        $image->generateXML($xmlWriter)->shouldBeCalled();

        $this->generateXML($xmlWriter);
    }
}
