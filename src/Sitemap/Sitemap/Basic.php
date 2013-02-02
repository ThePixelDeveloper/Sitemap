<?php

namespace Sitemap\Sitemap;

use Sitemap\Sitemap;

class Basic extends Sitemap
{
    private $priority;

    private $changeFreq;

    public function setChangeFreq($changeFreq)
    {
        $this->changeFreq = $changeFreq;
    }

    public function getChangeFreq()
    {
        return $this->changeFreq;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getPriority()
    {
        return $this->priority;
    }
}
