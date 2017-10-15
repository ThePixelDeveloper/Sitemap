<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

class ChunkedSitemapIndex extends ChunkedCollection
{
    protected function getCollectionClass(): Collection
    {
        return new SitemapIndex();
    }
}
