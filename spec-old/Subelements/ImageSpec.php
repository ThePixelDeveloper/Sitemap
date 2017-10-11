<?php

namespace spec\Thepixeldeveloper\Sitemap\Subelements;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImageSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('https://www.example.com/');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Subelements\Image');
    }

    function it_should_return_null_for_caption()
    {
        $this->getCaption()->shouldReturn(null);
    }

    function it_should_return_null_for_geo_location()
    {
        $this->getGeoLocation()->shouldReturn(null);
    }

    function it_should_return_null_for_title()
    {
        $this->getTitle()->shouldReturn(null);
    }

    function it_should_return_null_for_license()
    {
        $this->getLicense()->shouldReturn(null);
    }
}
