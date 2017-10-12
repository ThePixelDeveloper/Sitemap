<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;

class SitemapIndex extends Collection
{
    public function type(): string
    {
        return Sitemap::class;
    }

    public function accept(DriverInterface $driver)
    {
        $driver->visitSitemapIndex($this);

        foreach ($this->all() as $item) {
            $item->accept($driver);
        }
    }
}
