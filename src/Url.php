<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use DateTimeInterface;
use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Interfaces\VisitorInterface;

class Url implements VisitorInterface
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

    /**
     * Change frequency of the location.
     *
     * @var string
     */
    private $changeFreq;

    /**
     * Priority of page importance.
     *
     * @var string
     */
    private $priority;

    /**
     * Array of sub-elements.
     *
     * @var VisitorInterface[]
     */
    private $extensions = [];

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

    /**
     * @return string
     */
    public function getChangeFreq()
    {
        return $this->changeFreq;
    }

    /**
     * @param string $changeFreq
     */
    public function setChangeFreq(string $changeFreq)
    {
        $this->changeFreq = $changeFreq;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     */
    public function setPriority(string $priority)
    {
        $this->priority = $priority;
    }

    /**
     * @param VisitorInterface $extension
     */
    public function addExtension(VisitorInterface $extension)
    {
        $this->extensions[] = $extension;
    }

    /**
     * @return VisitorInterface[]
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    public function accept(DriverInterface $driver)
    {
        $driver->visitUrl($this);
    }
}
