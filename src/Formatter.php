<?php

namespace Thepixeldeveloper\Sitemap;

use Thepixeldeveloper\Sitemap\Generator\Sitemap as SitemapGenerator;
use Thepixeldeveloper\Sitemap\Generator\SitemapIndex as SitemapIndexGenerator;
use Thepixeldeveloper\Sitemap\Generator\Url as UrlGenerator;
use Thepixeldeveloper\Sitemap\Generator\Urlset as UrlsetGenerator;

class Formatter
{
    /**
     * @var bool
     */
    protected $indented = true;

    /**
     * @var string
     */
    protected $indentString = '    ';

    /**
     * @return boolean
     */
    public function isIndented()
    {
        return $this->indented;
    }

    /**
     * @param boolean $indented
     */
    public function setIndented($indented)
    {
        $this->indented = $indented;
    }

    /**
     * @return string
     */
    public function getIndentString()
    {
        return $this->indentString;
    }

    /**
     * @param string $indentString
     */
    public function setIndentString($indentString)
    {
        $this->indentString = $indentString;
    }

    public function format($collection)
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startDocument('1.0', 'UTF-8');
        $xmlWriter->setIndent($this->isIndented());
        $xmlWriter->setIndentString($this->getIndentString());

        if ($collection instanceof SitemapIndex) {
            $generator = new SitemapIndexGenerator($xmlWriter, new SitemapGenerator($xmlWriter));
        } elseif ($collection instanceof Urlset) {
            $generator = new UrlsetGenerator($xmlWriter, new UrlGenerator($xmlWriter));
        }

        if (!isset($generator)) {
            throw new \InvalidArgumentException(get_class($collection) . 'is not a support collection');
        }

        $generator->generate($collection);

        return trim($xmlWriter->flush(true));
    }
}
