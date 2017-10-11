<?php

namespace Thepixeldeveloper\Sitemap\Extensions;

use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Interfaces\VisitorInterface;

class Image implements VisitorInterface
{
    /**
     * Location (URL).
     *
     * @var string
     */
    protected $loc;

    /**
     * The caption of the image.
     *
     * @var string
     */
    protected $caption;

    /**
     * The geographic location of the image.
     *
     * @var string
     */
    protected $geoLocation;

    /**
     * The title of the image.
     *
     * @var string
     */
    protected $title;

    /**
     * A URL to the license of the image.
     *
     * @var string
     */
    protected $license;

    /**
     * Image constructor
     *
     * @param string $loc
     */
    public function __construct($loc)
    {
        $this->loc = $loc;
    }

    /**
     * Location (URL).
     *
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * The caption of the image.
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set the caption of the image.
     *
     * @param string $caption
     *
     * @return $this
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * The geographic location of the image.
     *
     * @return string
     */
    public function getGeoLocation()
    {
        return $this->geoLocation;
    }

    /**
     * Set the geographic location of the image.
     *
     * @param string $geoLocation
     *
     * @return $this
     */
    public function setGeoLocation($geoLocation)
    {
        $this->geoLocation = $geoLocation;

        return $this;
    }

    /**
     * The title of the image.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title of the image.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * A URL to the license of the image.
     *
     * @return string
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * Set a URL to the license of the image.
     *
     * @param string $license
     *
     * @return $this
     */
    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }

    public function accept(DriverInterface $driver)
    {
        $driver->visitImageExtension($this);
    }
}
