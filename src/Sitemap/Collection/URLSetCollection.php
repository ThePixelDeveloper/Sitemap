<?php

namespace Sitemap\Collection;

use Sitemap\Collection;

class URLSetCollection extends Collection
{
    protected function collectionName()
    {
        return 'urlset';
    }

    protected function entryWrapper()
    {
        return 'url';
    }
}
