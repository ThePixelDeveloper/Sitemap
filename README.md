Thepixeldeveloper\Sitemap
=========================

[![Author](http://img.shields.io/badge/author-@colonelrosa-blue.svg?style=flat-square)](https://twitter.com/colonelrosa)
[![Build Status](https://img.shields.io/travis/ThePixelDeveloper/Sitemap-v2/master.svg?style=flat-square)](https://travis-ci.org/ThePixelDeveloper/Sitemap-v2)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/thepixeldeveloper/sitemap.svg?style=flat-square)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Total Downloads](https://img.shields.io/packagist/dt/thepixeldeveloper/sitemap.svg?style=flat-square)](https://packagist.org/packages/thepixeldeveloper/sitemap)

A tool to generate XML sitemaps

Usage
-----

Generating a _urlset_ sitemap

``` php

$urlSet = new Thepixeldeveloper\Sitemap\Urlset(); 

foreach ($entities as $entity) {
  $urlSet->addUrl(
      new Thepixeldeveloper\Sitemap\Url($loc, $lastMod, $changeFreq, $priority)
  );
}
```

Generating a _sitemapindex_ sitemap


``` php

$sitemapIndex = new Thepixeldeveloper\Sitemap\SitemapIndex(); 

foreach ($entities as $entity) {
  $sitemapIndex->addUrl(
      new Thepixeldeveloper\Sitemap\Sitemap($loc, $lastMod)
  );
}
```

Then pass either SitemapIndex or Urlset to a Formatter to generate output


``` php
$formatter = new Thepixeldeveloper\Sitemap\Formatter();

echo $formatter->format($sitemapIndex);
```


Generating a sitemap with Google Images

``` php
$urlset = new Urlset();

$image2 = new Image('https://s3.amazonaws.com/path/to/image2');
$image2->setCaption('Test Caption');
$image2->setGeoLocation('Limerick, Ireland');
$image2->setTitle('Test Title');
$image2->setLicense('http://www.license.com');

$image = new Image('https://s3.amazonaws.com/path/to/image');

$imageUrl = new Url('http://www.example.com/1');
$imageUrl->addSubElement($image);
$imageUrl->addSubElement($image2);

$imageUrl2 = new Url('http://www.example.com/2');
$imageUrl2->addSubElement($image);
$imageUrl2->addSubElement($image2);

$urlset->addUrl($imageUrl);
$urlset->addUrl($imageUrl2);

$output = new Thepixeldeveloper\Sitemap\Output();

$output->getOutput($urlset);
```

Output

``` xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>http://www.example.com/1</loc>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image2</image:loc>
            <image:caption>Test Caption</image:caption>
            <image:geo_location>Limerick, Ireland</image:geo_location>
            <image:title>Test Title</image:title>
            <image:license>http://www.license.com</image:license>
        </image:image>
    </url>
    <url>
        <loc>http://www.example.com/2</loc>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image</image:loc>
        </image:image>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image2</image:loc>
            <image:caption>Test Caption</image:caption>
            <image:geo_location>Limerick, Ireland</image:geo_location>
            <image:title>Test Title</image:title>
            <image:license>http://www.license.com</image:license>
        </image:image>
    </url>
</urlset>
```
