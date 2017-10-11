<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SitemapSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('https://www.example.com/sitemap1.xml.gz');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Sitemap');
    }

    function it_should_have_a_loc()
    {
        $this->getLoc()->shouldReturn('https://www.example.com/sitemap1.xml.gz');
    }

    function it_should_have_a_last_mod()
    {
        $this->getLastMod()->shouldReturn(null);
    }
}
