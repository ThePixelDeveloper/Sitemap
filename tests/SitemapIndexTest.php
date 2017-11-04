<?php declare(strict_types=1);

namespace Tests\Thepixeldeveloper\Sitemap;

use PHPUnit\Framework\TestCase;
use Thepixeldeveloper\Sitemap\SitemapIndex;
use Thepixeldeveloper\Sitemap\Url;

class SitemapIndexTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCollectionType()
    {
        $sitemap = new Url('https://example.com');

        $sitemapIndex = new SitemapIndex();
        $sitemapIndex->add($sitemap);
    }
}
