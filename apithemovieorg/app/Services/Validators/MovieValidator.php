<?php

declare(strict_types=1);

namespace App\Services\Validators;

use InvalidArgumentException;

class MovieValidator
{
    /**
     * Validate that the given value is a string.
     *
     * @param mixed $value The value to validate.
     * @param string $field The name of the field being validated.
     * @return string The validated string.
     * @throws InvalidArgumentException if the value is not a string.
     */
    public function validateString($value, string $field): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("The {$field} must be a string.");
        }
        return $value;
    }

    /**
     * Validate that the given value is an integer.
     *
     * @param mixed $value The value to validate.
     * @param string $field The name of the field being validated.
     * @return int The validated integer.
     * @throws InvalidArgumentException if the value is not an integer.
     */
    public function validateInt($value, string $field): int
    {
        if (!is_int($value) && !ctype_digit((string)$value)) {
            throw new InvalidArgumentException("The {$field} must be an integer.");
        }
        return (int) $value;
    }

    /**
     * Validate that the given value is a float.
     *
     * @param mixed $value The value to validate.
     * @param string $field The name of the field being validated.
     * @return float The validated float.
     * @throws InvalidArgumentException if the value is not a float.
     */
    public function validateFloat($value, string $field): float
    {
        if (!is_float($value) && !is_numeric($value)) {
            throw new InvalidArgumentException("The {$field} must be a float.");
        }
        return (float) $value;
    }
}
