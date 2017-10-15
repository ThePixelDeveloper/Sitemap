<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Splitter;

use Thepixeldeveloper\Sitemap\Collection;
use Thepixeldeveloper\Sitemap\Interfaces\CollectionSplitterInterface;
use Thepixeldeveloper\Sitemap\Interfaces\VisitorInterface;

class CollectionSplitter implements CollectionSplitterInterface
{
    /**
     * @var Collection[]
     */
    private $collections;

    /**
     * @var Collection
     */
    private $collection;

    const LIMIT = 50000;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $count;

    /**
     * SitemapSplitter constructor.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collections = [];
        $this->collection = $collection;
        $this->limit = self::LIMIT;
        $this->count = 0;
    }

    public function add(VisitorInterface $visitor)
    {
        if ($this->count === 0 || $this->count === $this->limit) {
            $this->count = 0; $this->collections[] = clone $this->collection;
        }

        $this->collections[count($this->collections) - 1]->add($visitor);
        $this->count++;
    }

    public function getCollections(): array
    {
        return $this->collections;
    }
}
