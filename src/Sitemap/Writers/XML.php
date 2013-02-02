<?php

namespace Sitemap\Writers;

use Sitemap\Writer;

abstract class XML extends Writer
{
    protected function writer()
    {
        return new \XMLWriter;
    }
}
