<?php declare(strict_types=1);

namespace Tests\Thepixeldeveloper\Sitemap;

use PHPUnit\Framework\TestCase;
use Thepixeldeveloper\Sitemap\ChunkedSitemapIndex;
use Thepixeldeveloper\Sitemap\Sitemap;

class ChunkedSitemapIndexTest extends TestCase
{
    public function testChunkingWithOne()
    {
        $sitemap = new Sitemap('https://example.com');

        $sitemapIndex = new ChunkedSitemapIndex();
        $sitemapIndex->add($sitemap);

        $this->assertCount(1, $sitemapIndex->getCollections());
    }

    public function testChunkingWithMultiple()
    {
        $sitemap = new Sitemap('https://example.com');

        $sitemapIndex = new ChunkedSitemapIndex();

        for ($i = 0; $i < 50001; $i++) {
            $sitemapIndex->add($sitemap);
        }

        $this->assertCount(2, $sitemapIndex->getCollections());
    }
}
