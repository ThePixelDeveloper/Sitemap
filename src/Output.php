<?php

namespace Thepixeldeveloper\Sitemap;

class Output
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

    public function getOutput(OutputInterface $collection)
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startDocument('1.0', 'UTF-8');
        $xmlWriter->setIndent($this->isIndented());
        $xmlWriter->setIndentString($this->getIndentString());

        $collection->generateXML($xmlWriter);

        return trim($xmlWriter->flush(true));
    }
}
