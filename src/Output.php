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
     * Is the output indented.
     *
     * @var boolean
     */
    protected $indented = true;

    /**
     * What string is used for indentation.
     *
     * @var string
     */
    protected $indentString = '    ';

    /**
     * Renders the Sitemap as an XML string.
     *
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
     * Output indented?
     *
     * @return boolean
     */
    public function isIndented()
    {
        return $this->indented;
    }

    /**
     * Indent the output?
     *
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
     * String used for indentation.
     *
     * @return string
     */
    public function getIndentString()
    {
        return $this->indentString;
    }

    /**
     * Set the string used for indentation.
     * 
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
