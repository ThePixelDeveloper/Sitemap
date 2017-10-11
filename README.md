Thepixeldeveloper\Sitemap
=========================

[![pipeline status](https://gitlab.com/thepixeldeveloper/sitemap/badges/master/pipeline.svg)](https://gitlab.com/thepixeldeveloper/sitemap/commits/master)
[![License](https://poser.pugx.org/thepixeldeveloper/sitemap/license)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Latest Stable Version](https://poser.pugx.org/thepixeldeveloper/sitemap/v/stable)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Total Downloads](https://poser.pugx.org/thepixeldeveloper/sitemap/downloads)](https://packagist.org/packages/thepixeldeveloper/sitemap)
[![Monthly Downloads](https://poser.pugx.org/thepixeldeveloper/sitemap/d/monthly)](https://packagist.org/packages/thepixeldeveloper/sitemap)
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

**Processing Instructions**

You can add processing instructions on the output as such.

```php
$output = new Thepixeldeveloper\Sitemap\Output();
$output->addProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"');

echo $output->getOutput($urlset);
```

Which will add 

``` xml
<?xml-stylesheet type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"?>
```

before the document starts.

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
