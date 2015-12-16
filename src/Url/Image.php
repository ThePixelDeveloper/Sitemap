<?php

namespace Thepixeldeveloper\Sitemap\Url;

use Thepixeldeveloper\Sitemap\Url;

class Image extends Url
{
    /**
     * @var \Thepixeldeveloper\Sitemap\Image[]
     */
    protected $images = [];

    /**
     * @return \Thepixeldeveloper\Sitemap\Image[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param \Thepixeldeveloper\Sitemap\Image $image
     *
     * @return $this
     */
    public function addImage(\Thepixeldeveloper\Sitemap\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * @param \XMLWriter $XMLWriter
     */
    public function generateXML(\XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('url');
        $XMLWriter->writeElement('loc', $this->getLoc());

        $this->optionalWriteElement($XMLWriter, 'lastmod', $this->getLastMod());
        $this->optionalWriteElement($XMLWriter, 'changefreq', $this->getChangeFreq());
        $this->optionalWriteElement($XMLWriter, 'priority', $this->getPriority());

        foreach ($this->getImages() as $image) {
            $image->generateXML($XMLWriter);
        }

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
