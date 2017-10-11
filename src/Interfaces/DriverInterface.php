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
    public function visitSitemapIndex(SitemapIndex $sitemapIndex): void;

    public function visitSitemap(Sitemap $sitemap): void;

    public function visitUrlset(Urlset $urlset): void;

    public function visitUrl(Url $url): void;

    public function visitImageExtension(Image $image): void;

    public function visitLinkExtension(Link $link): void;

    public function visitMobileExtension(Mobile $mobile): void;

    public function visitNewsExtension(News $news): void;

    public function visitVideoExtension(Video $video): void;

    public function output(): string;
}
