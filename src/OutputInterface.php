<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

/**
 * Interface OutputInterface
 *
 * @package Thepixeldeveloper\Sitemap
 */
interface OutputInterface
{
    /**
     * @param XMLWriter $XMLWriter
     *
     * @return void
     */
    public function generateXML(XMLWriter $XMLWriter);
}
