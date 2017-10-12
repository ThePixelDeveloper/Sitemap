<?php

namespace spec\Thepixeldeveloper\Sitemap\Drivers;

use Thepixeldeveloper\Sitemap\Drivers\XmlWriterDriver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thepixeldeveloper\Sitemap\Extensions\Image;
use Thepixeldeveloper\Sitemap\Extensions\Link;
use Thepixeldeveloper\Sitemap\Extensions\Mobile;
use Thepixeldeveloper\Sitemap\Extensions\News;
use Thepixeldeveloper\Sitemap\Extensions\Video;
use Thepixeldeveloper\Sitemap\Sitemap;
use Thepixeldeveloper\Sitemap\SitemapIndex;
use Thepixeldeveloper\Sitemap\Url;
use Thepixeldeveloper\Sitemap\Urlset;

class XmlWriterDriverSpec extends ObjectBehavior
{
    function it_writes_out_processing_instructions()
    {
        $this->addProcessingInstructions('xml-stylesheet', 'type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"');

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="/path/to/xslt/main-sitemap.xsl"?>
XML
        );
    }

    function it_writes_a_sitemap_index(SitemapIndex $sitemapIndex)
    {
        $sitemapIndex->all()->willReturn([]);

        $this->visitSitemapIndex($sitemapIndex);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd"/>
XML
        );
    }

    function it_writes_a_sitemap(Sitemap $sitemap)
    {
        $date = new \DateTime();

        $sitemap->getLoc()->willReturn('https://example.com');
        $sitemap->getLastMod()->willReturn($date);

        $this->visitSitemap($sitemap);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemap><loc>https://example.com</loc><lastmod>{$date->format(DATE_W3C)}</lastmod></sitemap>
XML
        );
    }

    function it_writes_a_urlset(Urlset $urlset)
    {
        $urlset->all()->willReturn([]);

        $this->visitUrlset($urlset);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>
XML
        );
    }

    function it_writes_a_url(Url $url)
    {
        $date = new \DateTime();

        $url->getExtensions()->willReturn([]);
        $url->getLoc()->willReturn('https://example.com');
        $url->getLastMod()->willReturn($date);
        $url->getPriority()->willReturn(null);
        $url->getChangeFreq()->willReturn(null);

        $this->visitUrl($url);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<url><loc>https://example.com</loc><lastmod>{$date->format(DATE_W3C)}</lastmod></url>
XML
        );
    }

    function it_writes_the_image_extension(Image $image)
    {
        $image->getLoc()->willReturn(null);
        $image->getGeoLocation()->willReturn(null);
        $image->getCaption()->willReturn(null);
        $image->getTitle()->willReturn(null);
        $image->getLicense()->willReturn(null);

        $this->visitImageExtension($image);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<image:image/>
XML
        );
    }

    function it_writes_the_link_extension(Link $link)
    {
        $link->getHref()->willReturn('example');
        $link->getHrefLang()->willReturn('examples');

        $this->visitLinkExtension($link);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<xhtml:link rel="alternate" hreflang="examples" href="example"/>
XML
        );
    }

    function it_writes_the_mobile_extension(Mobile $mobile)
    {
        $this->visitMobileExtension($mobile);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<mobile:mobile/>
XML
        );
    }

    function it_writes_the_news_extension(News $news)
    {
        $news->getPublicationName()->willReturn('Example Publisher');
        $news->getPublicationLanguage()->willReturn(null);
        $news->getAccess()->willReturn(null);
        $news->getGenres()->willReturn(null);
        $news->getPublicationDate()->willReturn(null);
        $news->getTitle()->willReturn('Example Title');
        $news->getKeywords()->willReturn(null);

        $this->visitNewsExtension($news);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<news:news><news:publication><news:name>Example Publisher</news:name></news:publication><news:title>Example Title</news:title></news:news>
XML
        );
    }

    function it_writes_the_video_extension(Video $video)
    {
        $video->getTitle()->willReturn('Example Title');

        $video->getThumbnailLoc()->willReturn(null);
        $video->getDescription()->willReturn(null);
        $video->getContentLoc()->willReturn(null);
        $video->getPlayerLoc()->willReturn(null);
        $video->getDuration()->willReturn(null);
        $video->getExpirationDate()->willReturn(null);
        $video->getRating()->willReturn(null);
        $video->getViewCount()->willReturn(null);
        $video->getPublicationDate()->willReturn(null);
        $video->getFamilyFriendly()->willReturn(null);
        $video->getCategory()->willReturn(null);
        $video->getRestriction()->willReturn(null);
        $video->getGalleryLoc()->willReturn(null);
        $video->getPrice()->willReturn(null);
        $video->getRequiresSubscription()->willReturn(null);
        $video->getUploader()->willReturn(null);
        $video->getPlatform()->willReturn(null);
        $video->getLive()->willReturn(null);
        $video->getTags()->willReturn([]);

        $this->visitVideoExtension($video);

        $this->output()->shouldBe(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<video:video><video:title>Example Title</video:title></video:video>
XML
        );
    }
}
