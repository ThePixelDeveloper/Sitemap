<?php declare(strict_types=1);

namespace Tests\Thepixeldeveloper\Sitemap;

use PHPUnit\Framework\TestCase;
use Thepixeldeveloper\Sitemap\Url;

class UrlTest extends TestCase
{
    public function testGetters()
    {
        $location = 'https://example.com';

        $url = new Url($location);

        $this->assertSame($location, $url->getLoc());
        $this->assertSame([], $url->getExtensions());
        $this->assertNull($url->getChangeFreq());
        $this->assertNull($url->getPriority());
        $this->assertNull($url->getLastMod());
    }
}
