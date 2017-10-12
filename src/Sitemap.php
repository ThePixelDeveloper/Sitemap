<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use DateTimeInterface;
use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Interfaces\VisitorInterface;

class Sitemap implements VisitorInterface
{
    /**
     * Location (URL).
     *
     * @var string
     */
    private $loc;

    /**
     * Last modified time.
     *
     * @var DateTimeInterface
     */
    private $lastMod;

    public function __construct(string $loc)
    {
        $this->loc = $loc;
    }

    /**
     * @return string
     */
    public function getLoc(): string
    {
        return $this->loc;
    }

    /**
     * @return DateTimeInterface
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }

    /**
     * @param DateTimeInterface $lastMod
     */
    public function setLastMod(DateTimeInterface $lastMod)
    {
        $this->lastMod = $lastMod;
    }

    public function accept(DriverInterface $driver)
    {
        $driver->visitSitemap($this);
    }
}
