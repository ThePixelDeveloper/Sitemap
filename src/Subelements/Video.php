<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

class Video
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
    protected $rating;

    /**
     * @var
     */
    protected $expirationDate;

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
}
