<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use ArrayIterator;
use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Interfaces\VisitorInterface;
use Thepixeldeveloper\Sitemap\Traits\CollectionTrait;

class SitemapIndex extends ArrayIterator implements VisitorInterface
{
    use CollectionTrait;

    protected function getObject()
    {
        return Sitemap::class;
    }

    public function accept(DriverInterface $driver)
    {
        $driver->visitSitemapIndex($this);

        foreach ($this->items as $item) {
            $driver->visitSitemap($item);
        }
    }
}
