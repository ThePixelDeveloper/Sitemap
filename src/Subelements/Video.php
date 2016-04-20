<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

use Thepixeldeveloper\Sitemap\AppendAttributeInterface;
use Thepixeldeveloper\Sitemap\OutputInterface;
use XMLWriter;

/**
 * Class Video
 *
 * @package Thepixeldeveloper\Sitemap\Subelements
 */
class Video implements OutputInterface, AppendAttributeInterface
{
    /**
     * URL pointing to an image thumbnail.
     *
     * @var string
     */
    protected $thumbnailLoc;

    /**
     * Title of the video, max 100 characters.
     *
     * @var string
     */
    protected $title;

    /**
     * Description of the video, max 2048 characters.
     *
     * @var string
     */
    protected $description;

    /**
     * URL pointing to the actual media file (mp4).
     *
     * @var string
     */
    protected $contentLoc;

    /**
     * URL pointing to the player file (normally a SWF).
     *
     * @var string
     */
    protected $playerLoc;

    /**
     * Indicates whether the video is live.
     *
     * @var boolean
     */
    protected $live;

    /**
     * Duration of the video in seconds.
     *
     * @var integer
     */
    protected $duration;

    /**
     * String of space delimited platform values.
     *
     * Allowed values are web, mobile, and tv.
     *
     * @var string
     */
    protected $platform;

    /**
     * Does the video require a subscription?
     *
     * @var boolean
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
    public function getPlayerLoc()
    {
        return $this->playerLoc;
    }

    /**
     * @param mixed $playerLoc
     *
     * @return Video
     */
    public function setPlayerLoc($playerLoc)
    {
        $this->playerLoc = $playerLoc;

        return $this;
    }

    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('video:video');

        $XMLWriter->writeElement('video:thumbnail_loc', $this->getThumbnailLoc());
        $XMLWriter->writeElement('video:title', $this->getTitle());
        $XMLWriter->writeElement('video:description', $this->getDescription());

        $this->optionalWriteElement($XMLWriter, 'video:content_loc', $this->getContentLoc());
        $this->optionalWriteElement($XMLWriter, 'video:player_loc', $this->getPlayerLoc());
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
     * @return mixed
     */
    public function getContentLoc()
    {
        return $this->contentLoc;
    }

    /**
     * @param mixed $contentLoc
     *
     * @return Video
     */
    public function setContentLoc($contentLoc)
    {
        $this->contentLoc = $contentLoc;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     *
     * @return Video
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param mixed $expirationDate
     *
     * @return Video
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     *
     * @return Video
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @param mixed $viewCount
     *
     * @return Video
     */
    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     *
     * @return Video
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFamilyFriendly()
    {
        return $this->familyFriendly;
    }

    /**
     * @param mixed $familyFriendly
     *
     * @return Video
     */
    public function setFamilyFriendly($familyFriendly)
    {
        $this->familyFriendly = $familyFriendly;

        return $this;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     *
     * @return Video
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     *
     * @return Video
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * @param mixed $restriction
     *
     * @return Video
     */
    public function setRestriction($restriction)
    {
        $this->restriction = $restriction;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGalleryLoc()
    {
        return $this->galleryLoc;
    }

    /**
     * @param mixed $galleryLoc
     *
     * @return Video
     */
    public function setGalleryLoc($galleryLoc)
    {
        $this->galleryLoc = $galleryLoc;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     *
     * @return Video
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequiresSubscription()
    {
        return $this->requiresSubscription;
    }

    /**
     * @param mixed $requiresSubscription
     *
     * @return Video
     */
    public function setRequiresSubscription($requiresSubscription)
    {
        $this->requiresSubscription = $requiresSubscription;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUploader()
    {
        return $this->uploader;
    }

    /**
     * @param mixed $uploader
     *
     * @return Video
     */
    public function setUploader($uploader)
    {
        $this->uploader = $uploader;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param mixed $platform
     *
     * @return Video
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * @param mixed $live
     *
     * @return Video
     */
    public function setLive($live)
    {
        $this->live = $live;

        return $this;
    }

    /**
     * @param XMLWriter $XMLWriter
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->writeAttribute('xmlns:video', 'http://www.google.com/schemas/sitemap-video/1.1');
    }
}
