<?php

namespace Sitemap;

use Sitemap\Sitemap\SitemapEntry;
use Sitemap\Formatter\XML\URLSet;

class URLSetTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicXMLWriter()
    {
        $basic1 = new SitemapEntry('http://www.example.com/');
        $basic1->setPriority(0.8);
        $basic1->setChangeFreq('monthly');
        $basic1->setLastMod('2005-01-01');

        $basic2 = new SitemapEntry('http://www.example.com/catalog?item=12&desc=vacation_hawaii');
        $basic2->setChangeFreq('weekly');

        $urlsetCollection = new Collection;
        $urlsetCollection->addSitemap($basic1);
        $urlsetCollection->addSitemap($basic2);
        $urlsetCollection->setFormatter(new URLSet);

        $this->assertXmlStringEqualsXmlFile(__DIR__.'/../controls/basic.xml', (string) $urlsetCollection->output());
    }
}
