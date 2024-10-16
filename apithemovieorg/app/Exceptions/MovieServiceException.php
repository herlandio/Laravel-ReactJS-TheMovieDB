<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Class MovieServiceException
 *
 * This exception is thrown when an error occurs while processing a movie-related request.
 * It indicates that a failure has occurred within the MovieService layer.
 */
class MovieServiceException extends Exception
{
    /**
     * @var string The error message.
     */
    protected $message = 'An error occurred while processing your request.';

    /**
     * @var int The HTTP status code for this exception.
     */
    protected $code = 500;

    /**
     * MovieServiceException constructor.
     *
     * @param string|null $message Optional custom error message.
     * @param int|null $code Optional custom HTTP status code.
     */
    public function __construct(string $message = null, int $code = null)
    {
        if ($message) {
            $this->message = $message;
        }
        if ($code) {
            $this->code = $code;
        }
    }
}
