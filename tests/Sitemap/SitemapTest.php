<?php

namespace Sitemap;

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
        $sitemap = new Sitemap;
        $sitemap->setLocation($location);
        $sitemap->setLastMod($lastMod);

        $this->assertSame($location, $sitemap->getLocation());
        $this->assertSame($lastMod, $sitemap->getLastMod());
    }
}