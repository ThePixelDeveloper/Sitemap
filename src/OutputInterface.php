<?php

namespace Thepixeldeveloper\Sitemap;

interface OutputInterface
{
    /**
     * @param \XMLWriter $XMLWriter
     *
     * @return void
     */
    public function generateXML(\XMLWriter $XMLWriter);
}
