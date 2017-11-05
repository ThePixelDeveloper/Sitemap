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
        $url->setChangeFreq('monthly');
        $url->setPriority('0.8');

        $this->assertSame($location, $url->getLoc());
        $this->assertSame([], $url->getExtensions());
        $this->assertSame('monthly', $url->getChangeFreq());
        $this->assertSame('0.8', $url->getPriority());
        $this->assertNull($url->getLastMod());
    }
}
