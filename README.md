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

``` php

$basic = new \Sitemap\Sitemap\SitemapEntry('http://example.com/page-1');
$basic->setLastMod(time());

$collection = new \Sitemap\Collection;
$collection->addSitemap($basic);

// There's some different formatters available.
$collection->setFormatter(new \Sitemap\Formatter\XML\URLSet);
$collection->setFormatter(new \Sitemap\Formatter\XML\SitemapIndex);

$collection->output();
```

Output

``` xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://example.com/page-1</loc>
		<lastmod>1359837115</lastmod>
	</url>
</urlset>

<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<sitemap>
		<loc>http://example.com/page-1</loc>
		<lastmod>1359837115</lastmod>
	</sitemap>
</urlset>
```
