<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

/**
 * Class Output
 *
 * @package Thepixeldeveloper\Sitemap
 */
class Output
{
    /**
     * @var bool Is the output indented
     */
    protected $indented = true;

    /**
     * @var string What string is used for indentation
     */
    protected $indentString = '    ';

    /**
     * @param OutputInterface $collection
     *
     * @return string
     */
    public function getOutput(OutputInterface $collection)
    {
        $xmlWriter = new XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startDocument('1.0', 'UTF-8');
        $xmlWriter->setIndent($this->isIndented());
        $xmlWriter->setIndentString($this->getIndentString());

        $collection->generateXML($xmlWriter);

        return trim($xmlWriter->flush(true));
    }

    /**
     * @return boolean
     */
    public function isIndented()
    {
        return $this->indented;
    }

    /**
     * @param boolean $indented
     *
     * @return $this
     */
    public function setIndented($indented)
    {
        $this->indented = $indented;

        return $this;
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
     *
     * @return $this
     */
    public function setIndentString($indentString)
    {
        $this->indentString = $indentString;

        return $this;
    }
}
