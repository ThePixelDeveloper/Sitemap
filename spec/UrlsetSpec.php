<?php

namespace spec\Thepixeldeveloper\Sitemap;

use Thepixeldeveloper\Sitemap\Sitemap;
use PhpSpec\ObjectBehavior;

class UrlsetSpec extends ObjectBehavior
{
    function it_only_accepts_a_url(Sitemap $sitemap)
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('add', [$sitemap]);
    }
}
