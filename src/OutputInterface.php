<?php

namespace Thepixeldeveloper\Sitemap;

interface OutputInterface
{
    public function generateXML(\XMLWriter $XMLWriter);
}
