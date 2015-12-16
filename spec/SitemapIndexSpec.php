<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Sitemap;

class SitemapIndexSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\SitemapIndex');
    }

    function it_should_return_an_empty_array_by_default()
    {
        $this->getSitemaps()->shouldReturn([]);
    }

    function it_should_return_the_urls_added(Sitemap $sitemap)
    {
        $this->addSitemap($sitemap)->shouldReturn($this);

        $this->getSitemaps()->shouldReturn([$sitemap]);
    }
}
