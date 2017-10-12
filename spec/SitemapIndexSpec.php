<?php

namespace spec\Thepixeldeveloper\Sitemap;

use PhpSpec\ObjectBehavior;
use Thepixeldeveloper\Sitemap\Url;

class SitemapIndexSpec extends ObjectBehavior
{
    function it_only_accepts_a_sitemap(Url $url)
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('add', [$url]);
    }
}
