<?php

namespace spec\Thepixeldeveloper\Sitemap\Subelements;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MobileSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Subelements\Mobile');
    }
}
