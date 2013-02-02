<?php

namespace Sitemap\Writers;

use Sitemap\Sitemap\BasicSitemap;
use Sitemap\Collection;
use Sitemap\Writers\XML\IndexXMLWriter;

class IndexTest extends \PHPUnit_Framework_TestCase
{
    public function testIndexXMLWriter()
    {
        $sitemap1 = new BasicSitemap;
        $sitemap1->setLocation('http://www.example.com/sitemap1.xml.gz');
        $sitemap1->setLastMod('2004-10-01T18:23:17+00:00');

        $sitemap2 = new BasicSitemap;
        $sitemap2->setLocation('http://www.example.com/sitemap2.xml.gz');
        $sitemap2->setLastMod('2005-01-01');

        $index = new Collection;
        $index->addSitemap($sitemap1);
        $index->addSitemap($sitemap2);

        $writer = new IndexXMLWriter($index);

        $this->assertXmlStringEqualsXmlFile(__DIR__.'/../../controls/index.xml', (string) $writer->output());
    }
}
