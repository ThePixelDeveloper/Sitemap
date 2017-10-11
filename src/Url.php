<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap;

use DateTimeInterface;

class Url
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
    public function getLastMod(): ?DateTimeInterface
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
    public function getChangeFreq(): ?string
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
    public function getPriority(): ?string
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
}
