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
     * Generate the XML for a given element / sub-element.
     *
     * @param XMLWriter $XMLWriter
     *
     * @return void
     */
    public function generateXML(XMLWriter $XMLWriter);
}
