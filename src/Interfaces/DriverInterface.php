<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Interfaces;

use Thepixeldeveloper\Sitemap\Extensions\Image;
use Thepixeldeveloper\Sitemap\Extensions\Link;
use Thepixeldeveloper\Sitemap\Extensions\Mobile;
use Thepixeldeveloper\Sitemap\Extensions\News;
use Thepixeldeveloper\Sitemap\Extensions\Video;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

interface DriverInterface
{
    public function visitSitemapIndex(SitemapIndex $sitemapIndex);

    public function visitSitemap(Sitemap $sitemap);

    public function visitUrlset(Urlset $urlset);

    public function visitUrl(Url $url);

    public function visitImageExtension(Image $image);

    public function visitLinkExtension(Link $link);

    public function visitMobileExtension(Mobile $mobile);

    public function visitNewsExtension(News $news);

    public function visitVideoExtension(Video $video);

    public function output(): string;
}
