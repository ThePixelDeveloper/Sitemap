<?php

namespace Sitemap\Sitemap;

class SitemapEntry
{
    const CHANGEFREQ_ALWAYS  = 'always';
    const CHANGEFREQ_HOURLY  = 'hourly';
    const CHANGEFREQ_DAILY   = 'daily';
    const CHANGEFREQ_WEEKLY  = 'weekly';
    const CHANGEFREQ_MONTHLY = 'monthly';
    const CHANGEFREQ_YEARLY  = 'yearly';
    const CHANGEFREQ_NEVER   = 'never';

    protected $location;

    protected $lastMod;

    protected $priority;

    protected $changeFreq;

    public function __construct($loc, $lastMod = null, $changeFreq = null, $priority = null)
    {
        $this->setLocation($loc);
        $this->setLastMod($lastMod);
        $this->setChangeFreq($changeFreq);
        $this->setPriority($priority);
    }

    public function setLastMod($lastMod)
    {
        if ($lastMod instanceof \DateTime) {
            $lastMod = $lastMod->format(\DateTime::DATE_W3C);
        }

        $this->lastMod = $lastMod;

        return $this;
    }

    public function getLastMod()
    {
        return $this->lastMod;
    }

    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setChangeFreq($changeFreq)
    {
        if (in_array($changeFreq, array(
            self::CHANGEFREQ_ALWAYS,
            self::CHANGEFREQ_HOURLY,
            self::CHANGEFREQ_DAILY,
            self::CHANGEFREQ_WEEKLY,
            self::CHANGEFREQ_MONTHLY,
            self::CHANGEFREQ_YEARLY,
            self::CHANGEFREQ_NEVER,
        ))) {
            $this->changeFreq = $changeFreq;
        }

        return $this;
    }

    public function getChangeFreq()
    {
        return $this->changeFreq;
    }

    public function setPriority($priority)
    {
        if ($priority !== null)
        {
            $priority = round((float) $priority, 1);

            if ($priority < 0 || $priority > 1) {
                $priority = 0.5;
            }
        }

        $this->priority = $priority;

        return $this;
    }

    public function getPriority()
    {
        return $this->priority;
    }
}
