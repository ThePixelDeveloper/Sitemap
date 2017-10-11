<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use ArrayIterator;
use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Interfaces\VisitorInterface;
use Thepixeldeveloper\Sitemap\Traits\CollectionTrait;

class Urlset extends ArrayIterator implements VisitorInterface
{
    use CollectionTrait;

    protected function getObject(): ?string
    {
        return Url::class;
    }

    public function accept(DriverInterface $driver)
    {
        $driver->visitUrlset($this);
    }
}

