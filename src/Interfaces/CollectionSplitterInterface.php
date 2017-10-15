<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Interfaces;

interface CollectionSplitterInterface
{
    public function add(VisitorInterface $visitor);

    public function getCollections(): array;
}
