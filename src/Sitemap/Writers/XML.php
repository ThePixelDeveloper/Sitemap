<?php

namespace Sitemap\Writers;

use Sitemap\Writer;

abstract class XML extends Writer
{
    private $writer;

    protected function writer()
    {
        if ($this->writer) {
            return $this->writer;
        }

        $this->writer = new \XMLWriter;
        $this->writer->openMemory();
        return $this->writer;
    }

    protected function writeElementIfNotNull($name, $value)
    {
        if ($value) {
            $this->writer()->writeElement($name, $value);
        }
    }
}
