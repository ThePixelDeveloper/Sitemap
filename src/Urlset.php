<?php

namespace Thepixeldeveloper\Sitemap;

class Urlset
{
    protected $urls = [];

    /**
     * @return mixed
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @param Url $url
     *
     * @return $this
     */
    public function addUrl(Url $url)
    {
        $this->urls[] = $url;

        return $this;
    }
}
