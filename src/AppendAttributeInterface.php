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
     * Appends an attribute to the collection XML attributes.
     * 
     * @param XMLWriter $XMLWriter
     *
     * @return void
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter);
}
