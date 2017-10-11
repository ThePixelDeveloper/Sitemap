<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Interfaces;

interface VisitorInterface
{
    public function accept(DriverInterface $driver);
}
