<?php

namespace spec\Thepixeldeveloper\Sitemap;

use Thepixeldeveloper\Sitemap\SitemapIndex;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SitemapIndexSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SitemapIndex::class);
    }
}
