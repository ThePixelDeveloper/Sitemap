<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

class ChunkedUrlset extends ChunkedCollection
{
    protected function getCollectionClass(): Collection
    {
        return new Urlset();
    }
}
