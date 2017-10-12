Thepixeldeveloper\Sitemap
=========================

[![pipeline status](https://gitlab.com/thepixeldeveloper/sitemap/badges/master/pipeline.svg)](https://gitlab.com/thepixeldeveloper/sitemap/commits/master)
[![License](https://poser.pugx.org/thepixeldeveloper/sitemap/license)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Latest Stable Version](https://poser.pugx.org/thepixeldeveloper/sitemap/v/stable)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Total Downloads](https://poser.pugx.org/thepixeldeveloper/sitemap/downloads)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Monthly Downloads](https://poser.pugx.org/thepixeldeveloper/sitemap/d/monthly)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ThePixelDeveloper/Sitemap/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ThePixelDeveloper/Sitemap/?branch=master)

A tool to generate XML sitemaps.

Basic Usage
-----

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

echo $driver->getOutput();
```

Extensions
----------

The following extensions are supported: [Image](), [Link](), [Mobile](), [News]() and [Video]().
They work in the following way: (taking image as an example)

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

Advanced Usage
--------------

**Processing Instructions**

You can add processing instructions on the output as such.

```php
<?php declare(strict_types=1);

use Thepixeldeveloper\Sitemap\Drivers\XmlWriterDriver;

$driver = new XmlWriterDriver();
$driver->addProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"');
```

Which will add 

``` xml
<?xml-stylesheet type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"?>
```

before the document starts.

Why should I use this over [cartographer](https://github.com/tackk/cartographer)?
----

* This library has less complexity. All it's going to do is build an object graph and spit it out as XML
* Has support for a growing list of sub elements ie: mobile and images
* No dependencies. A library outputting XML doesn't need to rely on Flysystem
