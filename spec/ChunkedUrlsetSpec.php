<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

class ChunkedUrlsetSpec extends ObjectBehavior
{
    function let(Urlset $urlset)
    {
        $this->beConstructedWith($urlset);
    }

    function it_should_give_me_one_urlset_under_the_limit(Url $url)
    {
        $this->add($url);
        $this->getCollections()->shouldHaveCount(1);
    }

    function it_should_split_over_the_limit(Url $url)
    {
        for ($i = 0; $i < 50001; $i++) {
            $this->add($url);
        }

        $this->getCollections()->shouldHaveCount(2);
    }
}
