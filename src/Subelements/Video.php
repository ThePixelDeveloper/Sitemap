<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

use Thepixeldeveloper\Sitemap\AppendAttributeInterface;
use Thepixeldeveloper\Sitemap\OutputInterface;
use XMLWriter;

class Video implements OutputInterface, AppendAttributeInterface
{
    /**
     * @var
     */
    protected $thumbnailLoc;

    /**
     * @var
     */
    protected $title;

    /**
     * @var
     */
    protected $description;

    /**
     * @var
     */
    protected $contentLoc;

    /**
     * @var
     */
    protected $playerLoc;

    /**
     * @var
     */
    protected $live;

    /**
     * @var
     */
    protected $duration;

    /**
     * @var
     */
    protected $platform;

    /**
     * @var
     */
    protected $requiresSubscription;

    /**
     * @var
     */
    protected $price;

    /**
     * @var
     */
    protected $galleryLoc;

    /**
     * @var
     */
    protected $restriction;

    /**
     * @var array
     */
    protected $tags = [];

    /**
     * @var
     */
    protected $category;

    /**
     * @var
     */
    protected $familyFriendly;

    /**
     * @var
     */
    protected $publicationDate;

    /**
     * @var
     */
    protected $viewCount;

    /**
     * @var
     */
    protected $uploader;

    /**
     * @var
     */
    protected $rating;

    /**
     * @var
     */
    protected $expirationDate;

    /**
     * Video constructor.
     *
     * @param $thumbnailLoc
     * @param $title
     * @param $description
     */
    public function __construct($thumbnailLoc, $title, $description)
    {
        $this->thumbnailLoc = $thumbnailLoc;
        $this->title        = $title;
        $this->description  = $description;
    }

    /**
     * @return mixed
     */
    public function getThumbnailLoc()
    {
        return $this->thumbnailLoc;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getContentLoc()
    {
        return $this->contentLoc;
    }

    /**
     * @return mixed
     */
    public function getPlayerLoc()
    {
        return $this->playerLoc;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return mixed
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @return mixed
     */
    public function getFamilyFriendly()
    {
        return $this->familyFriendly;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * @return mixed
     */
    public function getGalleryLoc()
    {
        return $this->galleryLoc;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getRequiresSubscription()
    {
        return $this->requiresSubscription;
    }

    /**
     * @return mixed
     */
    public function getUploader()
    {
        return $this->uploader;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @return mixed
     */
    public function getLive()
    {
        return $this->live;
    }

    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('video:video');

        $XMLWriter->writeElement('video:thumbnail_loc', $this->getThumbnailLoc());
        $XMLWriter->writeElement('video:title', $this->getTitle());
        $XMLWriter->writeElement('video:description', $this->getDescription());

        $this->optionalWriteElement($XMLWriter, 'video:content_loc', $this->getContentLoc());
        $this->optionalWriteElement($XMLWriter, 'video:player_loc', $this->playerLoc);
        $this->optionalWriteElement($XMLWriter, 'video:duration', $this->getDuration());
        $this->optionalWriteElement($XMLWriter, 'video:expiration_date', $this->getExpirationDate());
        $this->optionalWriteElement($XMLWriter, 'video:rating', $this->getRating());
        $this->optionalWriteElement($XMLWriter, 'video:view_count', $this->getViewCount());
        $this->optionalWriteElement($XMLWriter, 'video:publication_date', $this->getPublicationDate());
        $this->optionalWriteElement($XMLWriter, 'video:family_friendly', $this->getFamilyFriendly());

        foreach ($this->getTags() as $tag) {
            $this->optionalWriteElement($XMLWriter, 'video:tag', $tag);
        }

        $this->optionalWriteElement($XMLWriter, 'video:category', $this->getCategory());
        $this->optionalWriteElement($XMLWriter, 'video:restriction', $this->getRestriction());
        $this->optionalWriteElement($XMLWriter, 'video:gallery_loc', $this->getGalleryLoc());
        $this->optionalWriteElement($XMLWriter, 'video:price', $this->getPrice());
        $this->optionalWriteElement($XMLWriter, 'video:requires_subscription', $this->getRequiresSubscription());
        $this->optionalWriteElement($XMLWriter, 'video:uploader', $this->getUploader());
        $this->optionalWriteElement($XMLWriter, 'video:platform', $this->getPlatform());
        $this->optionalWriteElement($XMLWriter, 'video:live', $this->getLive());

        $XMLWriter->endElement();
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
     * @param XMLWriter $XMLWriter
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->writeAttribute('xmlns:video', 'http://www.google.com/schemas/sitemap-video/1.1');
    }
}
