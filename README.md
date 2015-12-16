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
      new Thepixeldeveloper\Sitemap\Url(
          $loc,
          $lastMod,
          $changeFreq,
          $priority
      )
  );
}
```

Generating a _sitemapindex_ sitemap


``` php

$sitemapIndex = new Thepixeldeveloper\Sitemap\SitemapIndex(); 

foreach ($entities as $entity) {
  $sitemapIndex->addUrl(
      new Thepixeldeveloper\Sitemap\Sitemap(
          $loc,
          $lastMod
      )
  );
}
```

Then pass either SitemapIndex or Urlset to a Formatter to generate output


``` php
$formatter = new Thepixeldeveloper\Sitemap\Formatter();

echo $formatter->format($sitemapIndex);
```
