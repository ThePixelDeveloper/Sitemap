<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Drivers;

use Thepixeldeveloper\Sitemap\Extensions\Image;
use Thepixeldeveloper\Sitemap\Extensions\Link;
use Thepixeldeveloper\Sitemap\Extensions\Mobile;
use Thepixeldeveloper\Sitemap\Extensions\News;
use Thepixeldeveloper\Sitemap\Extensions\Video;
use Thepixeldeveloper\Sitemap\Interfaces\DriverInterface;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;
use XMLWriter;

/**
 * Class XmlWriterDriver
 *
 * Because this driver is forward only (can't go back and
 * define additional attributes) there's some logic
 *
 * @package Thepixeldeveloper\Sitemap\Drivers
 */
class XmlWriterDriver implements DriverInterface
{
    /**
     * @var XMLWriter
     */
    private $writer;

    /**
     * @var array
     */
    private $extensionAttributes = [
        Video::class  => [
            'name'   => 'xmlns:video',
            'content' => 'https://www.google.com/schemas/sitemap-video/1.1',
        ],
        News::class   => [
            'name'   => 'xmlns:news',
            'content' => 'https://www.google.com/schemas/sitemap-news/0.9',
        ],
        Mobile::class => [
            'name'   => 'xmlns:mobile',
            'content' => 'https://www.google.com/schemas/sitemap-mobile/1.0',
        ],
        Mobile::class => [
            'name'   => 'xmlns:xhtml',
            'content' => 'http://www.w3.org/1999/xhtml',
        ],
        Image::class  => [
            'name'   => 'xmlns:image',
            'content' => 'http://www.google.com/schemas/sitemap-image/1.1',
        ],
    ];

    /**
     * @var array
     */
    private $extensions = [];

    /**
     * XmlWriterDriver constructor.
     */
    public function __construct()
    {
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');

        $this->writer = $writer;
    }

    public function visitSitemapIndex(SitemapIndex $sitemapIndex): void
    {
        $this->writer->startElement('sitemapindex');
        $this->writer->writeAttribute('xmlns:xsi', 'https://www.w3.org/2001/XMLSchema-instance');

        $this->writer->writeAttribute(
            'xsi:schemaLocation',
            'http://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd'
        );
    }

    public function visitSitemap(Sitemap $sitemap): void
    {
        $this->writer->startElement('sitemap');
        $this->writer->writeElement('loc', $sitemap->getLoc());

        if ($lastMod = $sitemap->getLastMod()) {
            $this->writer->writeElement('lastmod', $lastMod->format(DATE_W3C));
        }

        $this->writer->endElement();
    }

    public function visitUrlset(Urlset $urlset): void
    {
        $this->writer->startElement('urlset');
        $this->writer->writeAttribute('xmlns:xsi', 'https://www.w3.org/2001/XMLSchema-instance');

        $this->writer->writeAttribute(
            'xsi:schemaLocation',
            'http://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd'
        );

        $this->writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urlset->all() as $item) {
            $item->accept($this);
        }

        $this->writer->endElement();
    }

    public function visitUrl(Url $url): void
    {
        foreach ($url->getExtensions() as $extension) {
            $extensionClass      = get_class($extension);
            $extensionAttributes = $this->extensionAttributes[$extensionClass];

            if (!in_array($extensionClass, $this->extensions, true)) {
                $this->extensions[] = $extensionClass;
                $this->writer->writeAttribute($extensionAttributes['name'], $extensionAttributes['content']);
            }
        }

        $this->writer->startElement('url');
        $this->writer->writeElement('loc', $url->getLoc());

        if ($lastMod = $url->getLastMod()) {
            $this->writer->writeElement('lastmod', $lastMod->format(DATE_W3C));
        }

        if ($changeFreq = $url->getChangeFreq()) {
            $this->writer->writeElement('changefreq', $changeFreq);
        }

        if ($priority = $url->getPriority()) {
            $this->writer->writeElement('priority', $priority);
        }

        foreach ($url->getExtensions() as $extension) {
            $extension->accept($this);
        }

        $this->writer->endElement();
    }

    public function visitImageExtension(Image $image): void
    {
        $this->writer->startElement('image:image');
        $this->writer->writeElement('image:loc', $image->getLoc());

        if ($caption = $image->getCaption()) {
            $this->writer->writeElement('image:caption', $caption);
        }

        if ($geoLocation = $image->getGeoLocation()) {
            $this->writer->writeElement('image:geo_location', $geoLocation);
        }

        if ($title = $image->getTitle()) {
            $this->writer->writeElement('image:title', $title);
        }

        if ($license = $image->getLicense()) {
            $this->writer->writeElement('image:license', $license);
        }

        $this->writer->endElement();
    }

    public function visitLinkExtension(Link $link): void
    {
        $this->writer->startElement('xhtml:link');
        $this->writer->writeAttribute('rel', 'alternate');
        $this->writer->writeAttribute('hreflang', $link->getHrefLang());
        $this->writer->writeAttribute('href', $link->getHref());
        $this->writer->endElement();
    }

    public function visitMobileExtension(Mobile $mobile): void
    {
        $this->writer->writeElement('mobile:mobile');
    }

    public function visitNewsExtension(News $news): void
    {
        $this->writer->startElement('news:news');
        $this->writer->startElement('news:publication');
        $this->writer->writeElement('news:name', $news->getPublicationName());
        $this->writer->writeElement('news:language', $news->getPublicationLanguage());
        $this->writer->endElement();

        if ($access = $news->getAccess()) {
            $this->writer->writeElement('news:access', $access);
        }

        if ($genres = $news->getGenres()) {
            $this->writer->writeElement('news:genres', $genres);
        }

        $this->writer->writeElement('news:publication_date', $news->getPublicationDate()->format(DATE_ATOM));
        $this->writer->writeElement('news:title', $news->getTitle());

        if ($keywords = $news->getKeywords()) {
            $this->writer->writeElement('news:keywords', $keywords);
        }

        $this->writer->endElement();
    }

    public function visitVideoExtension(Video $video): void
    {
        $this->writer->startElement('video:video');

        $this->writer->writeElement('video:thumbnail_loc', $video->getThumbnailLoc());
        $this->writer->writeElement('video:title', $video->getTitle());
        $this->writer->writeElement('video:description', $video->getDescription());

        if ($contentLoc = $video->getContentLoc()) {
            $this->writer->writeElement('video:content_loc', $contentLoc);
        }

        if ($playerLoc = $video->getPlayerLoc()) {
            $this->writer->writeElement('video:player_loc', $playerLoc);
        }

        if ($duration = $video->getDuration()) {
            $this->writer->writeElement('video:duration', $duration);
        }

        if ($expirationDate = $video->getExpirationDate()) {
            $this->writer->writeElement('video:expiration_date', $expirationDate);
        }

        if ($rating = $video->getRating()) {
            $this->writer->writeElement('video:rating', $rating);
        }

        if ($viewCount = $video->getViewCount()) {
            $this->writer->writeElement('video:view_count', $viewCount);
        }

        if ($publicationDate = $video->getPublicationDate()) {
            $this->writer->writeElement('video:publication_date', $publicationDate);
        }

        if ($familyFriendly = $video->getFamilyFriendly()) {
            $this->writer->writeElement('video:family_friendly', $familyFriendly);
        }

        foreach ($video->getTags() as $tag) {
            $this->writer->writeElement('video:tag', $tag);
        }

        if ($category = $video->getCategory()) {
            $this->writer->writeElement('video:category', $category);
        }

        if ($restriction = $video->getRestriction()) {
            $this->writer->writeElement('video:restriction', $restriction);
        }

        if ($galleryLoc = $video->getGalleryLoc()) {
            $this->writer->writeElement('video:gallery_loc', $galleryLoc);
        }

        if ($price = $video->getPrice()) {
            $this->writer->writeElement('video:price', $price);
        }

        if ($requiresSubscription = $video->getRequiresSubscription()) {
            $this->writer->writeElement('video:requires_subscription', $requiresSubscription);
        }

        if ($uploader = $video->getUploader()) {
            $this->writer->writeElement('video:uploader', $uploader);
        }

        if ($platform = $video->getPlatform()) {
            $this->writer->writeElement('video:platform', $platform);
        }

        if ($live = $video->getLive()) {
            $this->writer->writeElement('video:live', $live);
        }

        $this->writer->endElement();
    }

    public function output(): string
    {
        return $this->writer->flush();
    }
}
