<?php declare(strict_types=1);

namespace Thepixeldeveloper\Sitemap\Exceptions;

use Exception;
use Throwable;

class InvalidCollectionItemException extends Exception
{
    /**
     * InvalidCollectionItemException constructor.
     *
     * @param mixed          $value
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($value, $code = 0, Throwable $previous = null)
    {
        $message = '';

        parent::__construct($message, $code, $previous);
    }
}
