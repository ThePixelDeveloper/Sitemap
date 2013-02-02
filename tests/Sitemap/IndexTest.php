<?php

namespace Sitemap;

class IndexTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $sitemap1 = new Sitemap;
        $sitemap1->setLocation('http://example.com/sitemap.xml');
        $sitemap1->setLastMod(time());

        $sitemap2 = new Sitemap;
        $sitemap2->setLocation('http://example.com/blog.xml');
        $sitemap2->setLastMod(time());

        $index = new Index;

        $index->addSitemap($sitemap1);
        $index->addSitemap($sitemap2);

        $this->assertCount(2, $index->getSitemaps());

        $index->addSitemap($sitemap1);

        $this->assertCount(2, $index->getSitemaps());
    }
}