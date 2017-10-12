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
    private $processingInstructions = [];

    /**
     * @var array
     */
    private $extensionAttributes = [
        Video::class  => [
            'name'    => 'xmlns:video',
            'content' => 'https://www.google.com/schemas/sitemap-video/1.1',
        ],
        News::class   => [
            'name'    => 'xmlns:news',
            'content' => 'https://www.google.com/schemas/sitemap-news/0.9',
        ],
        Mobile::class => [
            'name'    => 'xmlns:mobile',
            'content' => 'https://www.google.com/schemas/sitemap-mobile/1.0',
        ],
        Mobile::class => [
            'name'    => 'xmlns:xhtml',
            'content' => 'http://www.w3.org/1999/xhtml',
        ],
        Image::class  => [
            'name'    => 'xmlns:image',
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

        foreach ($this->processingInstructions as $target => $content) {
            $writer->writePI($target, $content);
        }

        $this->writer = $writer;
    }

    public function addProcessingInstructions(string $target, string $content): void
    {
        $this->processingInstructions[$target] = $content;
    }

    private function writeElement(string $name, $content): void
    {
        if (!$content) {
            return;
        }

        if ($content instanceof \DateTimeInterface) {
            $this->writer->writeElement($name, $content->format(DATE_W3C));
        } else {
            $this->writer->writeElement($name, $content);
        }
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

        $this->writer->writeAttribute(
            'xmlns:xsi',
            'https://www.w3.org/2001/XMLSchema-instance'
        );

        $this->writer->writeAttribute(
            'xsi:schemaLocation',
            'http://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd'
        );

        $this->writer->writeAttribute(
            'xmlns',
            'http://www.sitemaps.org/schemas/sitemap/0.9'
        );

        foreach ($urlset->all() as $item) {
            $item->accept($this);
        }

        $this->writer->endElement();
    }

    public function visitUrl(Url $url): void
    {
        foreach ($url->getExtensions() as $extension) {
            $extensionClass = get_class($extension);
            $extensionAttributes = $this->extensionAttributes[$extensionClass];

            if (!in_array($extensionClass, $this->extensions, true)) {
                $this->extensions[] = $extensionClass;
                $this->writer->writeAttribute($extensionAttributes['name'], $extensionAttributes['content']);
            }
        }

        $this->writer->startElement('url');
        $this->writeElement('loc', $url->getLoc());
        $this->writeElement('lastmod', $url->getLastMod());
        $this->writeElement('changefreq', $url->getChangeFreq());
        $this->writeElement('priority', $url->getPriority());

        foreach ($url->getExtensions() as $extension) {
            $extension->accept($this);
        }

        $this->writer->endElement();
    }

    public function visitImageExtension(Image $image): void
    {
        $this->writer->startElement('image:image');
        $this->writeElement('image:loc', $image->getLoc());
        $this->writeElement('image:caption', $image->getCaption());
        $this->writeElement('image:geo_location', $image->getGeoLocation());
        $this->writeElement('image:title', $image->getTitle());
        $this->writeElement('image:license', $image->getLicense());
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
        $this->writeElement('news:name', $news->getPublicationName());
        $this->writeElement('news:language', $news->getPublicationLanguage());
        $this->writer->endElement();

        $this->writeElement('news:access', $news->getAccess());
        $this->writeElement('news:genres', $news->getGenres());
        $this->writeElement('news:publication_date', $news->getPublicationDate());
        $this->writeElement('news:title', $news->getTitle());
        $this->writeElement('news:keywords', $news->getKeywords());

        $this->writer->endElement();
    }

    public function visitVideoExtension(Video $video): void
    {
        $this->writer->startElement('video:video');

        $this->writeElement('video:thumbnail_loc', $video->getThumbnailLoc());
        $this->writeElement('video:title', $video->getTitle());
        $this->writeElement('video:description', $video->getDescription());
        $this->writeElement('video:content_loc', $video->getContentLoc());
        $this->writeElement('video:player_loc', $video->getPlayerLoc());
        $this->writeElement('video:duration', $video->getDuration());
        $this->writeElement('video:expiration_date', $video->getExpirationDate());
        $this->writeElement('video:rating', $video->getRating());
        $this->writeElement('video:view_count', $video->getViewCount());
        $this->writeElement('video:publication_date', $video->getPublicationDate());
        $this->writeElement('video:family_friendly', $video->getFamilyFriendly());
        $this->writeElement('video:category', $video->getCategory());
        $this->writeElement('video:restriction', $video->getRestriction());
        $this->writeElement('video:gallery_loc', $video->getGalleryLoc());
        $this->writeElement('video:price', $video->getPrice());
        $this->writeElement('video:requires_subscription', $video->getRequiresSubscription());
        $this->writeElement('video:uploader', $video->getUploader());
        $this->writeElement('video:platform', $video->getPlatform());
        $this->writeElement('video:live', $video->getLive());

        foreach ($video->getTags() as $tag) {
            $this->writeElement('video:tag', $tag);
        }

        $this->writer->endElement();
    }

    public function output(): string
    {
        return $this->writer->flush();
    }
}
