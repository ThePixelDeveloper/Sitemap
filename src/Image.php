<?php

namespace Thepixeldeveloper\Sitemap;

class Image implements OutputInterface
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

    public function generateXML(\XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('image:image');
        $XMLWriter->writeElement('image:loc', $this->getLocation());

        $this->optionalWriteElement($XMLWriter, 'image:caption', $this->getCaption());
        $this->optionalWriteElement($XMLWriter, 'image:geo_location', $this->getGeoLocation());
        $this->optionalWriteElement($XMLWriter, 'image:title', $this->getTitle());
        $this->optionalWriteElement($XMLWriter, 'image:license', $this->getLicense());

        $XMLWriter->endElement();
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
}
