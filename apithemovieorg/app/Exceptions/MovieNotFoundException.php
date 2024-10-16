<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Class MovieNotFoundException
 *
 * This exception is thrown when a movie is not found in the database.
 * It indicates that the requested movie could not be located.
 */
class MovieNotFoundException extends Exception
{
    /**
     * @var string The error message.
     */
    protected $message = 'Movie not found.';

    /**
     * @var int The HTTP status code for this exception.
     */
    protected $code = 404;

    /**
     * MovieNotFoundException constructor.
     *
     * @param string|null $message Optional custom error message.
     */
    public function __construct(string $message = null)
    {
        if ($message) {
            $this->message = $message;
        }
    }
}

