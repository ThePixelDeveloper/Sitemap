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
class News implements OutputInterface, AppendAttributeInterface
{
    /**
     * Location (URL).
     *
     * @var string
     */
    protected $loc;

    /**
     * Publication name.
     *
     * @var string
     */
    protected $publicationName;

    /**
     * Publication language.
     *
     * @var string
     */
    protected $publicationLanguage;

    /**
     * Access.
     *
     * @var string
     */
    protected $access;

    /**
     * List of genres, comma-separated string values.
     *
     * @var string
     */
    protected $genres;

    /**
     * Date of publication.
     *
     * @var \DateTime
     */
    protected $publicationDate;

    /**
     * Title.
     *
     * @var string
     */
    protected $title;

    /**
     * Key words, comma-separated string values.
     *
     * @var string
     */
    protected $keywords;

    /**
     * Publication name.
     *
     * @return string
     */
    public function getPublicationName()
    {
        return $this->publicationName;
    }

    /**
     * Set the publication name.
     *
     * @param string $publicationName
     *
     * @return $this
     */
    public function setPublicationName($publicationName)
    {
        $this->publicationName = $publicationName;

        return $this;
    }

    /**
     * Publication language.
     *
     * @return string
     */
    public function getPublicationLanguage()
    {
        return $this->publicationLanguage;
    }

    /**
     * Set the publication language.
     *
     * @param string $publicationLanguage
     *
     * @return $this
     */
    public function setPublicationLanguage($publicationLanguage)
    {
        $this->publicationLanguage = $publicationLanguage;

        return $this;
    }

    /**
     * Access.
     *
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set access.
     *
     * @param string $access
     *
     * @return $this
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * List of genres, comma-separated string values.
     *
     * @return string
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set list of genres, comma-separated string values.
     *
     * @param string $genres
     *
     * @return $this
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * Date of publication.
     *
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set date of publication.
     *
     * @param \DateTime $publicationDate
     *
     * @return $this
     */
    public function setPublicationDate(\DateTime $publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
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
     * Key words, comma-separated string values.
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set key words, comma-separated string values.
     *
     * @param string $keywords
     *
     * @return $this
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
