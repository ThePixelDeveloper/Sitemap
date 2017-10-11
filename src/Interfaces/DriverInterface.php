<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Interfaces;

use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;

interface DriverInterface
{
    public function visitSitemapIndex(SitemapIndex $sitemapIndex);

    public function visitSitemap(Sitemap $sitemap);

    public function output(): string;
}
