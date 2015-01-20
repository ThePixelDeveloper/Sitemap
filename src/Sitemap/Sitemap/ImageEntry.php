<?php

namespace Sitemap\Sitemap;

class ImageEntry
{
    protected $location;

    protected $caption;

    protected $geoLocation;

    protected $title;

    protected $license;

    public function __construct($location)
    {
        $this->setLocation($location);
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    public function getGeoLocation()
    {
        return $this->geoLocation;
    }

    public function setGeoLocation($geoLocation)
    {
        $this->geoLocation = $geoLocation;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getLicense()
    {
        return $this->license;
    }

    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }
}
