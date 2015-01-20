<?php

namespace Sitemap;

use Sitemap\Sitemap\ImageEntry;
use Sitemap\Sitemap\SitemapImageEntry;
use Sitemap\Formatter\XML\SitemapImage;

class SitemapImageTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicImagesXMLWriter()
    {
        // Image 1
        $image1 = new ImageEntry('https://s3.amazonaws.com/path/to/image');

        // Image 2 with multiple attributes
        $image2 = new ImageEntry('https://s3.amazonaws.com/path/to/image2');
        $image2->setCaption('Test Caption');
        $image2->setGeoLocation('Limerick, Ireland');
        $image2->setTitle('Test Title');
        $image2->setLicense('http://www.license.com');

        $basic1 = new SitemapImageEntry('http://www.example.com/1');
        $basic1->addImages($image1);
        $basic1->addImages($image2);

        $basic2 = new SitemapImageEntry('http://www.example.com/2');
        $basic2->addImages($image1);
        $basic2->addImages($image2);

        $collection = new Collection;
        $collection->addSitemap($basic1);
        $collection->addSitemap($basic2);
        $collection->setFormatter(new SitemapImage);

        $this->assertXmlStringEqualsXmlFile(
            __DIR__.'/../controls/image.xml',
            (string) $collection->output()
        );
    }

}
