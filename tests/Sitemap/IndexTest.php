<?php

namespace Sitemap;

use Sitemap\Collection;
use Sitemap\Sitemap\BasicSitemap;

class IndexTest extends \PHPUnit_Framework_TestCase
{
    public function testIndexDeDuplication()
    {
        $time = time();

        $sitemap1 = new BasicSitemap;
        $sitemap1->setLocation('http://example.com/sitemap.xml');
        $sitemap1->setLastMod($time);

        $sitemap2 = new BasicSitemap;
        $sitemap2->setLocation('http://example.com/sitemap.xml');
        $sitemap2->setLastMod($time);

        $index = new Collection;

        $index->addSitemap($sitemap1);
        $index->addSitemap($sitemap2);

        $this->assertCount(1, $index->getSitemaps());
    }
}