Thepixeldeveloper\Sitemap
=========================

[![Author](http://img.shields.io/badge/author-@colonelrosa-blue.svg?style=flat-square)](https://twitter.com/colonelrosa)
[![Build Status](https://img.shields.io/travis/ThePixelDeveloper/Sitemap-v2/master.svg?style=flat-square)](https://travis-ci.org/ThePixelDeveloper/Sitemap-v2)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/thepixeldeveloper/sitemap.svg?style=flat-square)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Total Downloads](https://img.shields.io/packagist/dt/thepixeldeveloper/sitemap.svg?style=flat-square)](https://packagist.org/packages/thepixeldeveloper/sitemap)

A tool to generate XML sitemaps

Basic Usage
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

Then pass either SitemapIndex or Urlset to `Output` to generate output


``` php
$formatter = new Thepixeldeveloper\Sitemap\Output();

echo $formatter->getOutput($sitemapIndex);
```

Advanced Usage
--------------

**Google Images**

``` php
$urlset = new Urlset();

$image = new Thepixeldeveloper\Sitemap\Image('https://s3.amazonaws.com/path/to/image');

$imageUrl = new Thepixeldeveloper\Sitemap\Url('http://www.example.com/1');
$imageUrl->addSubElement($image);;

$urlset->addUrl($imageUrl);

echo (new Thepixeldeveloper\Sitemap\Output())->getOutput($urlset);
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
    </url>
</urlset>
```
