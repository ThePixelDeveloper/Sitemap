<?php

namespace Thepixeldeveloper\Sitemap;

use XMLWriter;

interface OutputInterface
{
    /**
     * @param XMLWriter $XMLWriter
     *
     * @return void
     */
    public function generateXML(XMLWriter $XMLWriter);
}
