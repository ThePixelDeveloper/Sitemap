<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

interface AppendAttributeInterface
{
    /**
     * @param XMLWriter $XMLWriter
     *
     * @return void
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter);
}
