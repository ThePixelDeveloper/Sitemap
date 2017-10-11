<?php

namespace spec\Thepixeldeveloper\Sitemap\Subelements;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LinkSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('en', 'https://www.example.com/');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Subelements\Link');
    }

    function it_should_return_en_for_hreflang()
    {
        $this->getHreflang()->shouldReturn('en');
    }

    function it_should_return_url_for_href()
    {
        $this->getHref()->shouldReturn('https://www.example.com/');
    }
}
