<?php

namespace Thepixeldeveloper\Sitemap\Subelements;

use Thepixeldeveloper\Sitemap\AppendAttributeInterface;
use Thepixeldeveloper\Sitemap\OutputInterface;
use XMLWriter;

/**
 * Class Mobile
 *
 * @package Thepixeldeveloper\Sitemap\Subelements
 */
class Mobile implements OutputInterface, AppendAttributeInterface
{
    /**
     * {@inheritdoc}
     */
    public function appendAttributeToCollectionXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->writeAttribute('xmlns:mobile', 'http://www.google.com/schemas/sitemap-mobile/1.0');
    }

    /**
     * {@inheritdoc}
     */
    public function generateXML(XMLWriter $XMLWriter)
    {
        $XMLWriter->writeElement('mobile:mobile');
    }
}
