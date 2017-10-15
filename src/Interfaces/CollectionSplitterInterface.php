<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Interfaces;

use Thepixeldeveloper\Sitemap\Collection;

interface CollectionSplitterInterface
{
    public function add(VisitorInterface $visitor);

    /**
     * @return Collection[]
     */
    public function getCollections(): array;
}
