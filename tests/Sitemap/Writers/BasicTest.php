<?php

namespace Sitemap\Writers;

use Sitemap\Sitemap\Basic;
use Sitemap\Index;

class BasicTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicXMLWriter()
    {
        $basic1 = new Basic;
        $basic1->setPriority(0.8);
        $basic1->setChangeFreq('monthly');
        $basic1->setLastMod('2005-01-01');
        $basic1->setLocation('http://www.example.com/');

        $basic2 = new Basic;
        $basic2->setChangeFreq('weekly');
        $basic2->setLocation('http://www.example.com/catalog?item=12&desc=vacation_hawaii');

        $index = new \Sitemap\URLSet;
        $index->addSitemap($basic1);
        $index->addSitemap($basic2);

        $writer = new \Sitemap\Writers\XML\URLSet($index);

        $this->assertXmlStringEqualsXmlFile(__DIR__.'/../../controls/basic.xml', (string) $writer->output());
    }
}
