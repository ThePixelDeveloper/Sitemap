<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Url;

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
}
