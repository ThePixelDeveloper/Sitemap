<?php declare(strict_types=1);

namespace Tests\Thepixeldeveloper\Sitemap;

use PHPUnit\Framework\TestCase;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

class UrlsetTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCollectionType()
    {
        $sitemap = new Sitemap('https://example.com');

        $urlset = new Urlset();
        $urlset->add($sitemap);
    }
}
