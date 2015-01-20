<?php

namespace Sitemap\Sitemap;

class SitemapImageEntry
{
    protected $location;

    protected $images = array();

    public function __construct($location)
    {
        $this->setLocation($location);
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

    public function addImages(ImageEntry $images)
    {
        $this->images[serialize($images)] = $images;
        return $this;
    }

    public function getImages()
    {
        return $this->images;
    }
}
