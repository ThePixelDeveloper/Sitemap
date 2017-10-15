<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;

class Urlset extends Collection
{
    public function type(): string
    {
        return Url::class;
    }

    public function accept(DriverInterface $driver)
    {
        $driver->visitUrlset($this);
    }
}
