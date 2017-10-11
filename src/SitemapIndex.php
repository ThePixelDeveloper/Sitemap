<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use ArrayIterator;
use Thepixeldeveloper\Sitemap\Traits\CollectionTrait;

class SitemapIndex extends ArrayIterator
{
    use CollectionTrait;

    protected function isValid($value): bool
    {
        return $value instanceof Sitemap;
    }
}
