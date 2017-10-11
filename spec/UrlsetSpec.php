<?php

namespace spec\Thepixeldeveloper\Sitemap;

use Thepixeldeveloper\Sitemap\Urlset;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UrlsetSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Urlset::class);
    }
}
