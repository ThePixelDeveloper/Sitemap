<?php

namespace Thepixeldeveloper\Sitemap\Extensions;

use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Interfaces\VisitorInterface;
use XMLWriter;

/**
 * Class Mobile
 *
 * @package Thepixeldeveloper\Sitemap\Subelements
 */
class Mobile implements VisitorInterface
{
    public function accept(DriverInterface $driver)
    {
        $driver->visitMobileExtension($this);
    }
}
