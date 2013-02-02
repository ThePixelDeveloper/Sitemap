<?php

namespace Sitemap;

use Sitemap\Sitemap\BasicSitemap;

class SitemapTest extends \PHPUnit_Framework_TestCase
{
    public function sitemapProvider()
    {
        return array(
            array('http://example.com/sitemap-1.xml', time()),
        );
    }

    /**
     * @dataProvider sitemapProvider
     */
    public function testNew($location, $lastMod)
    {
        $sitemap = new BasicSitemap;
        $sitemap->setLocation($location);
        $sitemap->setLastMod($lastMod);

        $this->assertSame($location, $sitemap->getLocation());
        $this->assertSame($lastMod, $sitemap->getLastMod());
    }
}