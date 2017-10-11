<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Traits;

use Thepixeldeveloper\Sitemap\Exceptions\InvalidCollectionItemException;

trait CollectionTrait
{
    /**
     * A collection of valid items for the collection.
     *
     * @var array
     */
    private $items = [];

    /**
     * Checks to see if the offset has a non null value.
     *
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * Returns an item from the collection.
     *
     * @param $offset
     *
     * @return null
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    /**
     * Set an item, validates the value.
     *
     * @param $offset
     * @param $value
     *
     * @throws InvalidCollectionItemException
     */
    public function offsetSet($offset, $value)
    {
        if (!$this->getObject() instanceof $value) {
            throw new InvalidCollectionItemException($value);
        }

        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * Remove an item from the collection.
     *
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * @return null|string
     */
    protected function getObject(): ?string
    {
        return null;
    }
}
