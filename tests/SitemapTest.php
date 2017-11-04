<?php declare(strict_types=1);

namespace Tests\Thepixeldeveloper\Sitemap;

use PHPUnit\Framework\TestCase;
use Thepixeldeveloper\Sitemap\Sitemap;

class SitemapTest extends TestCase
{
    public function testGetters()
    {
        $location = 'https://example.com';

        $sitemap = new Sitemap($location);

        $this->assertSame($location, $sitemap->getLoc());
        $this->assertNull($sitemap->getLastMod());
    }
}
