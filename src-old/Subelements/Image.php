<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

use XMLWriter;
use Thepixeldeveloper\Sitemap\OutputInterface;
use Thepixeldeveloper\Sitemap\AppendAttributeInterface;

/**
 * Class Image
 *
 * @package Thepixeldeveloper\Sitemap\Subelements
 */
class Image implements OutputInterface, AppendAttributeInterface
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
     * {@inheritdoc}
     */
    public function generateXML(XMLWriter $XMLWriter)
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
     * Location (URL).
     *
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * @param XMLWriter $XMLWriter
     * @param string    $name
     * @param string    $value
     */
    protected function optionalWriteElement(XMLWriter $XMLWriter, $name, $value)
    {
        if ($value) {
            $XMLWriter->writeElement($name, $value);
        }
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

    /**
     * {@inheritdoc}
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->writeAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');
    }
}
