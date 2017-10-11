<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use ArrayIterator;
use Thepixeldeveloper\Sitemap\Traits\CollectionTrait;

class Urlset extends ArrayIterator
{
    use CollectionTrait;

    protected function getObject(): ?string
    {
        return Url::class;
    }
}

