Thepixeldeveloper\Sitemap
=========================

[![Author](http://img.shields.io/badge/author-@colonelrosa-blue.svg)](https://twitter.com/colonelrosa)
[![Version Status](http://php-eye.com/badge/thepixeldeveloper/sitemap/tested.svg?style=flat)](https://travis-ci.org/ThePixelDeveloper/Sitemap)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/thepixeldeveloper/sitemap.svg)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Total Downloads](https://img.shields.io/packagist/dt/thepixeldeveloper/sitemap.svg)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/ed6d56e8-c908-44dc-9154-a8edc8b168bc.svg)](https://insight.sensiolabs.com/projects/ed6d56e8-c908-44dc-9154-a8edc8b168bc)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ThePixelDeveloper/Sitemap/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ThePixelDeveloper/Sitemap/?branch=master)


A tool to generate XML sitemaps

Basic Usage
-----

Generating a urlset sitemap

``` php
$urlSet = new Thepixeldeveloper\Sitemap\Urlset(); 

$url = (new Thepixeldeveloper\Sitemap\Url($loc))
  ->setLastMod($lastMod)
  ->setChangeFreq($changeFreq)
  ->setPriority($priority);

$urlSet->addUrl($url);
```

Generating a sitemapindex sitemap


``` php
$sitemapIndex = new Thepixeldeveloper\Sitemap\SitemapIndex(); 

$url = (new Thepixeldeveloper\Sitemap\Sitemap($loc))
  ->setLastMod($lastMod);
  
$sitemapIndex->addSitemap($url);
```

Then pass either SitemapIndex or Urlset to `Output` to generate output


``` php
echo (new Thepixeldeveloper\Sitemap\Output())->getOutput($sitemapIndex);
```

Subelements
-----------

You can add more specific information to a URL entry, ie video / image information

**Image**

``` php
$subelement = new Thepixeldeveloper\Sitemap\Subelements\Image('https://s3.amazonaws.com/path/to/image');
```

**Video**

``` php
$subelement = new Thepixeldeveloper\Sitemap\Subelements\Video('thumbnail', 'title', 'description');
```

**Mobile**

``` php
$subelement = new Thepixeldeveloper\Sitemap\Subelements\Mobile();
```

**Link**

``` php
$subelement = new Thepixeldeveloper\Sitemap\Subelements\Link('de', 'http://www.example.com/schweiz-deutsch/');
```

**News**

``` php
$subelement = (new Thepixeldeveloper\Sitemap\Subelements\News())
    ->setPublicationDate(new \DateTime())
    ->setPublicationLanguage('en')
    ->setPublicationName('Site Name')
    ->setTitle('Some title');
```

Then you need to add the subelement to the URL

``` php
$url = new Thepixeldeveloper\Sitemap\Url('http://www.example.com/1')
$url->addSubelement($subelement);
```

and rendering is described above.

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


Why should I use this over [cartographer](https://github.com/tackk/cartographer)?
----

* This library has less complexity. All it's going to do is build an object graph and spit it out as XML
* Has support for a growing list of sub elements ie: mobile and images
* No dependencies. A library outputting XML doesn't need to rely on Flysystem
