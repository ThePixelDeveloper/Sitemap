Thepixeldeveloper\Sitemap
=========================

[![Author](http://img.shields.io/badge/author-@colonelrosa-blue.svg)](https://twitter.com/colonelrosa)
[![Build Status](https://img.shields.io/travis/ThePixelDeveloper/Sitemap-v2/master.svg)](https://travis-ci.org/ThePixelDeveloper/Sitemap-v2)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/thepixeldeveloper/sitemap.svg)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Total Downloads](https://img.shields.io/packagist/dt/thepixeldeveloper/sitemap.svg)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/ed6d56e8-c908-44dc-9154-a8edc8b168bc.svg)](https://insight.sensiolabs.com/projects/ed6d56e8-c908-44dc-9154-a8edc8b168bc)

A tool to generate XML sitemaps

Basic Usage
-----

Generating a urlset sitemap

``` php
$urlSet = new Thepixeldeveloper\Sitemap\Urlset(); 

$url = (new Thepixeldeveloper\Sitemap\Url($loc))
  ->setLastMod($lastMod);
  ->setChangeFreq($changeFreq);
  ->setPriority($priority);

$urlSet->addUrl($url);
```

Generating a sitemapindex sitemap


``` php
$sitemapIndex = new Thepixeldeveloper\Sitemap\SitemapIndex(); 

$url = (new Thepixeldeveloper\Sitemap\Sitemap($loc))
  ->setLastMod($lastMod);
  
$sitemapIndex->addUrl($url);
```

Then pass either SitemapIndex or Urlset to `Output` to generate output


``` php
echo (new Thepixeldeveloper\Sitemap\Output())->getOutput($sitemapIndex);
```

Advanced Usage
--------------

**Indenting output**

Output is indented by default, can be turned off as follows

``` php
echo (new Thepixeldeveloper\Sitemap\Output())
    ->setIndented(false)
    ->getOutput($urlSet);
```

Configuration

Name | Default | Values
---- | ------- | ------
setIndented | true | boolean
setIndentString | 4 spaces | string 


**Google Images**

``` php
$urlset = new Thepixeldeveloper\Sitemap\Urlset();
$image  = new Thepixeldeveloper\Sitemap\Subelements\Image('https://s3.amazonaws.com/path/to/image');

$url = (new Thepixeldeveloper\Sitemap\Url('http://www.example.com/1'))
    ->addSubelement($image);

$urlset->addUrl($url);

echo (new Thepixeldeveloper\Sitemap\Output())->getOutput($urlset);
```

Output

``` xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>http://www.example.com/1</loc>
        <image:image>
            <image:loc>https://s3.amazonaws.com/path/to/image</image:loc>
        </image:image>
    </url>
</urlset>
```

Why should I use this over [cartographer](https://github.com/tackk/cartographer)?
----

* This library has less complexity. All it's going to do is build an object graph and spit it out as XML
* Has support for a growing list of sub elements ie: mobile and images
* No dependencies. A library outputting XML doesn't need to rely on Flysystem
