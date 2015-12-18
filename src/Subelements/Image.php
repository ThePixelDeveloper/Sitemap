<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

use Thepixeldeveloper\Sitemap\OutputInterface;

/**
 * Class Image
 *
 * @package Thepixeldeveloper\Sitemap\Subelements
 */
class Image implements OutputInterface
{
    /**
     * @var string
     */
    protected $loc;

    /**
     * @var string
     */
    protected $caption;

    /**
     * @var string
     */
    protected $geoLocation;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $license;

    /**
     * Image constructor
     *
     * @param $loc
     */
    public function __construct($loc)
    {
        $this->loc = $loc;
    }

    /**
     * @param \XMLWriter $XMLWriter
     */
    public function generateXML(\XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('image:image');
        $XMLWriter->writeElement('image:loc', $this->getLoc());

        $this->optionalWriteElement($XMLWriter, 'image:caption', $this->getCaption());
        $this->optionalWriteElement($XMLWriter, 'image:geo_location', $this->getGeoLocation());
        $this->optionalWriteElement($XMLWriter, 'image:title', $this->getTitle());
        $this->optionalWriteElement($XMLWriter, 'image:license', $this->getLicense());

        $XMLWriter->endElement();
    }

    /**
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * @param \XMLWriter $XMLWriter
     * @param string     $name
     * @param string     $value
     */
    protected function optionalWriteElement(\XMLWriter $XMLWriter, $name, $value)
    {
        if ($value) {
            $XMLWriter->writeElement($name, $value);
        }
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param $caption
     *
     * @return $this
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @return string
     */
    public function getGeoLocation()
    {
        return $this->geoLocation;
    }

    /**
     * @param $geoLocation
     *
     * @return $this
     */
    public function setGeoLocation($geoLocation)
    {
        $this->geoLocation = $geoLocation;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * @param $license
     *
     * @return $this
     */
    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }
}
