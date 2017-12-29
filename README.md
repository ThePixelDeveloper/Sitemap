# Thepixeldeveloper\Sitemap

[![pipeline status](https://www.devkit.net/thepixeldeveloper/sitemap/badges/master/pipeline.svg)](https://www.devkit.net/thepixeldeveloper/sitemap/commits/master)
[![coverage report](https://www.devkit.net/thepixeldeveloper/sitemap/badges/master/coverage.svg)](https://www.devkit.net/thepixeldeveloper/sitemap/commits/master)
[![License](https://poser.pugx.org/thepixeldeveloper/sitemap/license)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Latest Stable Version](https://poser.pugx.org/thepixeldeveloper/sitemap/v/stable)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Total Downloads](https://poser.pugx.org/thepixeldeveloper/sitemap/downloads)](https://packagist.org/packages/thepixeldeveloper/sitemap)

A tool to generate XML sitemaps. Integrates with Symfony via [SitemapBundle](https://github.com/thepixeldeveloper/sitemapbundle)

* [Installation](#installation)
* [Basic Usage](#basic-usage)
* [Advanced Usage](#advanced-usage)
* [Extensions](#extensions)

## Installation

``` bash
composer require "thepixeldeveloper/sitemap"
```

## Basic Usage

Generating a typical (\<urlset\>) sitemap.

``` php
<?php declare(strict_types=1);

use Thepixeldeveloper\Sitemap\Urlset;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Drivers\XmlWriterDriver;

$url = new Url($loc);
$url->setLastMod($lastMod);
$url->setChangeFreq($changeFreq);
$url->setPriority($priority);

$urlset = new Urlset();
$urlSet->add($url);

$driver = new XmlWriterDriver();
$urlset->accept($driver);

echo $driver->getOutput();
```

Generating a parent (\<sitemapindex\>) sitemap.

``` php
<?php declare(strict_types=1);

use Thepixeldeveloper\Sitemap\SitemapIndex;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\Drivers\XmlWriterDriver;

// Sitemap entry.
$url = new Sitemap($loc);
$url->setLastMod($lastMod);

// Add it to a collection.
$urlset = new SitemapIndex();
$urlSet->add($url);

$driver = new XmlWriterDriver();
$urlset->accept($driver);

echo $driver->output();
```

## Extensions

The following extensions are supported: [Image](tree/master/src/Extensions/Image.php), [Link](tree/master/src/Extensions/Link.php), [Mobile](tree/master/src/Extensions/Mobile.php), [News](tree/master/src/Extensions/News.php) and [Video](tree/master/src/Extensions/Video.php). They work in the
following way (taking image as an example):

``` php
<?php declare(strict_types=1);

use Thepixeldeveloper\Sitemap\Urlset;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Extensions\Image;

$url = new Url($loc);
$url->setLastMod($lastMod);
$url->setChangeFreq($changeFreq);
$url->setPriority($priority);

$image = new Image('https://image-location.com');

$url->addExtension($image);

...
```

## Advanced Usage

**Processing Instructions**

You can add processing instructions on the output as such.

```php
<?php declare(strict_types=1);

use Thepixeldeveloper\Sitemap\Drivers\XmlWriterDriver;

$driver = new XmlWriterDriver();
$driver->addProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"');
```

Which will add before the document starts.

``` xml
<?xml-stylesheet type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"?>
```


