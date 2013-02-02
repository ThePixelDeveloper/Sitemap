<?php

namespace Sitemap\Writers;

use Sitemap\Sitemap;
use Sitemap\Index;

class IndexTest extends \PHPUnit_Framework_TestCase
{
    public function testIndexXMLWriter()
    {
        $sitemap1 = new Sitemap;
        $sitemap1->setLocation('http://www.example.com/sitemap1.xml.gz');
        $sitemap1->setLastMod('2004-10-01T18:23:17+00:00');

        $sitemap2 = new Sitemap;
        $sitemap2->setLocation('http://www.example.com/sitemap2.xml.gz');
        $sitemap2->setLastMod('2005-01-01');

        $index = new Index;
        $index->addSitemap($sitemap1);
        $index->addSitemap($sitemap2);

        $writer = new \Sitemap\Writers\XML\Index($index);

        $this->assertXmlStringEqualsXmlFile(__DIR__.'/../../controls/index.xml', (string) $writer->output());
    }
}
