<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

/**
 * Interface AppendAttributeInterface
 *
 * @package Thepixeldeveloper\Sitemap
 */
interface AppendAttributeInterface
{
    /**
     * @param XMLWriter $XMLWriter
     *
     * @return void
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter);
}
