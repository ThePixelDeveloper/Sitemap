<?php

namespace spec\Thepixeldeveloper\Sitemap\Subelements;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VideoSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('thumbnail', 'title', 'description');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Thepixeldeveloper\Sitemap\Subelements\Video');
    }

    function it_should_have_a_thumbnail_loc()
    {
        $this->getThumbnailLoc()->shouldReturn('thumbnail');
    }

    function it_should_have_a_title()
    {
        $this->getTitle()->shouldReturn('title');
    }

    function it_should_have_a_description()
    {
        $this->getDescription()->shouldReturn('description');
    }

    function it_should_have_a_content_loc()
    {
        $this->getContentLoc();
    }

    function it_should_have_a_player_loc()
    {
        $this->getPlayerLoc();
    }

    function it_should_have_a_duration()
    {
        $this->getDuration();
    }

    function it_should_have_an_expiration_date()
    {
        $this->getExpirationDate();
    }

    function it_should_have_a_rating()
    {
        $this->getRating();
    }

    function it_should_have_a_view_count()
    {
        $this->getViewCount();
    }

    function it_should_have_a_publication_date()
    {
        $this->getPublicationDate();
    }

    function it_should_have_a_family_friendly_option()
    {
        $this->getFamilyFriendly();
    }

    function it_should_have_tags()
    {
        $this->getTags();
    }

    function it_should_have_a_category()
    {
        $this->getCategory();
    }

    function it_should_have_a_restriction()
    {
        $this->getRestriction();
    }

    function it_should_have_a_gallery_loc()
    {
        $this->getGalleryLoc();
    }

    function it_should_have_a_price()
    {
        $this->getPrice();
    }

    function it_should_have_a_requires_subscription()
    {
        $this->getRequiresSubscription();
    }

    function it_should_have_an_uploader()
    {
        $this->getUploader();
    }

    function it_should_have_a_platform()
    {
        $this->getPlatform();
    }

    function it_should_have_a_live_property()
    {
        $this->getLive();
    }
}
