<?php

namespace Sitemap\Collection;

use Sitemap\Collection;

class SitemapIndexCollection extends Collection
{
    protected function collectionName()
    {
        return 'sitemapindex';
    }

    protected function entryWrapper()
    {
        return 'sitemap';
    }
}
