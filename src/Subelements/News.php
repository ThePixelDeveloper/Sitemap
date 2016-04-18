<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

use Thepixeldeveloper\Sitemap\AppendAttributeInterface;
use Thepixeldeveloper\Sitemap\OutputInterface;
use XMLWriter;
/**
 * Class Image
 *
 * @package Thepixeldeveloper\Sitemap\Subelements
 */
class News implements OutputInterface, AppendAttributeInterface
{
    /**
     * @var string
     */
    protected $loc;

    /**
     * Publication name
     *
     * @var string
     */
    protected $publicationName;

    /**
     * Publication language
     *
     * @var string
     */
    protected $publicationLanguage;

    /**
     * Access
     *
     * @var string
     */
    protected $access;

    /**
     * List of genres, comma-separated string values
     * @var string
     */
    protected $genres;

    /**
     * Date of publication
     *
     * @var \DateTime
     */
    protected $publicationDate;

    /**
     * Title
     *
     * @var string
     */
    protected $title;

    /**
     * Key words, comma-separated string values
     *
     * @var string
     */
    protected $keywords;

    /**
     * @return string
     */
    public function getPublicationName()
    {
        return $this->publicationName;
    }

    /**
     * @param string $publicationName
     * @return News
     */
    public function setPublicationName($publicationName)
    {
        $this->publicationName = $publicationName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPublicationLanguage()
    {
        return $this->publicationLanguage;
    }

    /**
     * @param string $publicationLanguage
     * @return News
     */
    public function setPublicationLanguage($publicationLanguage)
    {
        $this->publicationLanguage = $publicationLanguage;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param string $access
     * @return News
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param string $genres
     * @return News
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param \DateTime $publicationDate
     * @return News
     */
    public function setPublicationDate(\DateTime $publicationDate)
    {
        $this->publicationDate = $publicationDate;

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
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     * @return News
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->writeAttribute('xmlns:news', 'http://www.google.com/schemas/sitemap-news/0.9');
    }

    /**
     * @inheritDoc
     */
    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->startElement('news:news');
        $XMLWriter->startElement('news:publication');
        $XMLWriter->writeElement('news:name', $this->getPublicationName());
        $XMLWriter->writeElement('news:language', $this->getPublicationLanguage());
        $XMLWriter->endElement();
        $this->optionalWriteElement($XMLWriter, 'news:access', $this->getAccess());
        $this->optionalWriteElement($XMLWriter, 'news:genres', $this->getGenres());
        $XMLWriter->writeElement('news:publication_date', $this->getPublicationDate()->format(DATE_ISO8601));
        $XMLWriter->writeElement('news:title', $this->getTitle());
        $this->optionalWriteElement($XMLWriter, 'news:keywords', $this->getKeywords());
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
}