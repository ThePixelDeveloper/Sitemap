<?php

namespace Thepixeldeveloper\Sitemap\Extensions;

use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Interfaces\VisitorInterface;

class Video implements VisitorInterface
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
     * The price to download or view the video in ISO 4217 format.
     *
     * @link https://en.wikipedia.org/wiki/ISO_4217
     *
     * @var string
     */
    protected $price;

    /**
     * Link to gallery of which this video appears in.
     *
     * @var string
     */
    protected $galleryLoc;

    /**
     * A space-delimited list of countries where the video may or may not be played.
     *
     * @var string
     */
    protected $restriction;

    /**
     * A tag associated with the video.
     *
     * @var array
     */
    protected $tags = [];

    /**
     * The video's category. For example, cooking.
     *
     * @var string
     */
    protected $category;

    /**
     * No if the video should be available only to users with SafeSearch turned off.
     *
     * @var string
     */
    protected $familyFriendly;

    /**
     * The date the video was first published.
     *
     * @var \DateTimeInterface
     */
    protected $publicationDate;

    /**
     * The number of times the video has been viewed.
     *
     * @var integer
     */
    protected $viewCount;

    /**
     * The video uploader's name. Only one <video:uploader> is allowed per video.
     *
     * @var string
     */
    protected $uploader;

    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @var float
     */
    protected $rating;

    /**
     * The date after which the video will no longer be available
     *
     * @var \DateTimeInterface
     */
    protected $expirationDate;

    /**
     * Video constructor.
     *
     * @param string $thumbnailLoc
     * @param string $title
     * @param string $description
     */
    public function __construct($thumbnailLoc, $title, $description)
    {
        $this->thumbnailLoc = $thumbnailLoc;
        $this->title        = $title;
        $this->description  = $description;
    }

    /**
     * URL pointing to the player file (normally a SWF).
     *
     * @return string
     */
    public function getPlayerLoc()
    {
        return $this->playerLoc;
    }

    /**
     * URL pointing to the player file (normally a SWF).
     *
     * @param string $playerLoc
     *
     * @return $this
     */
    public function setPlayerLoc($playerLoc)
    {
        $this->playerLoc = $playerLoc;

        return $this;
    }

    /**
     * URL pointing to an image thumbnail.
     *
     * @return string
     */
    public function getThumbnailLoc()
    {
        return $this->thumbnailLoc;
    }

    /**
     * Title of the video, max 100 characters.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Description of the video, max 2048 characters.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * URL pointing to the actual media file (mp4).
     *
     * @return string
     */
    public function getContentLoc()
    {
        return $this->contentLoc;
    }

    /**
     * URL pointing to the actual media file (mp4).
     *
     * @param string $contentLoc
     *
     * @return $this
     */
    public function setContentLoc($contentLoc)
    {
        $this->contentLoc = $contentLoc;

        return $this;
    }

    /**
     * Duration of the video in seconds.
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Duration of the video in seconds.
     *
     * @param integer $duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * The date after which the video will no longer be available.
     *
     * @return \DateTimeInterface
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * The date after which the video will no longer be available.
     *
     * @param \DateTimeInterface $expirationDate
     *
     * @return $this
     */
    public function setExpirationDate(\DateTimeInterface $expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param float $rating
     *
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * The number of times the video has been viewed.
     *
     * @return integer
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * The number of times the video has been viewed.
     *
     * @param integer $viewCount
     *
     * @return $this
     */
    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    /**
     * The date the video was first published, in W3C format.
     *
     * @return \DateTimeInterface
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * The date the video was first published, in W3C format.
     *
     * @param \DateTimeInterface $publicationDate
     *
     * @return $this
     */
    public function setPublicationDate(\DateTimeInterface $publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * No if the video should be available only to users with SafeSearch turned off.
     *
     * @return string
     */
    public function getFamilyFriendly()
    {
        return $this->familyFriendly;
    }

    /**
     * No if the video should be available only to users with SafeSearch turned off.
     *
     * @param string $familyFriendly
     *
     * @return $this
     */
    public function setFamilyFriendly($familyFriendly)
    {
        $this->familyFriendly = $familyFriendly;

        return $this;
    }

    /**
     * A tag associated with the video.
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * A tag associated with the video.
     *
     * @param array $tags
     *
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * The video's category. For example, cooking.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * The video's category. For example, cooking.
     *
     * @param string $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * A space-delimited list of countries where the video may or may not be played.
     *
     * @return string
     */
    public function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * A space-delimited list of countries where the video may or may not be played.
     *
     * @param string $restriction
     *
     * @return $this
     */
    public function setRestriction($restriction)
    {
        $this->restriction = $restriction;

        return $this;
    }

    /**
     * Link to gallery of which this video appears in.
     *
     * @return string
     */
    public function getGalleryLoc()
    {
        return $this->galleryLoc;
    }

    /**
     * Link to gallery of which this video appears in.
     *
     * @param string $galleryLoc
     *
     * @return $this
     */
    public function setGalleryLoc($galleryLoc)
    {
        $this->galleryLoc = $galleryLoc;

        return $this;
    }

    /**
     * The price to download or view the video in ISO 4217 format.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * The price to download or view the video in ISO 4217 format.
     *
     * @param string $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Does the video require a subscription?
     *
     * @return boolean
     */
    public function getRequiresSubscription()
    {
        return $this->requiresSubscription;
    }

    /**
     * Does the video require a subscription?
     *
     * @param boolean $requiresSubscription
     *
     * @return $this
     */
    public function setRequiresSubscription($requiresSubscription)
    {
        $this->requiresSubscription = $requiresSubscription;

        return $this;
    }

    /**
     * The video uploader's name. Only one <video:uploader> is allowed per video.
     *
     * @return string
     */
    public function getUploader()
    {
        return $this->uploader;
    }

    /**
     * The video uploader's name. Only one <video:uploader> is allowed per video.
     *
     * @param string $uploader
     *
     * @return $this
     */
    public function setUploader($uploader)
    {
        $this->uploader = $uploader;

        return $this;
    }

    /**
     * String of space delimited platform values.
     *
     * Allowed values are web, mobile, and tv.
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * String of space delimited platform values.
     *
     * Allowed values are web, mobile, and tv.
     *
     * @param string $platform
     *
     * @return $this
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Indicates whether the video is live.
     *
     * @return boolean
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * Indicates whether the video is live.
     *
     * @param boolean $live
     *
     * @return $this
     */
    public function setLive($live)
    {
        $this->live = $live;

        return $this;
    }

    public function accept(DriverInterface $driver)
    {
        $driver->visitVideoExtension($this);
    }
}
