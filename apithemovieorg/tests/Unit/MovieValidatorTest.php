<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Validators\MovieValidator;
use InvalidArgumentException;

class MovieValidatorTest extends TestCase
{
    private MovieValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new MovieValidator();
    }

    /**
     * Test the validateString method with valid string input.
     *
     * @return void
     */
    public function testValidateStringWithValidInput(): void
    {
        $field = 'title';
        $result = $this->validator->validateString('Inception', $field);
        $this->assertEquals('Inception', $result);
    }

    /**
     * Test the validateString method with invalid input (not a string).
     *
     * @return void
     */
    public function testValidateStringWithInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The title must be a string.");
        $this->validator->validateString(123, 'title');
    }

    /**
     * Test the validateInt method with valid integer input.
     *
     * @return void
     */
    public function testValidateIntWithValidInput(): void
    {
        $field = 'year';
        $result = $this->validator->validateInt(2021, $field);
        $this->assertEquals(2021, $result);
    }

    /**
     * Test the validateInt method with valid string numeric input.
     *
     * @return void
     */
    public function testValidateIntWithStringNumericInput(): void
    {
        $field = 'year';
        $result = $this->validator->validateInt('2021', $field);
        $this->assertEquals(2021, $result);
    }

    /**
     * Test the validateInt method with invalid input (not an integer).
     *
     * @return void
     */
    public function testValidateIntWithInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The year must be an integer.");
        $this->validator->validateInt('abc', 'year');
    }

    /**
     * Test the validateFloat method with valid float input.
     *
     * @return void
     */
    public function testValidateFloatWithValidInput(): void
    {
        $field = 'rating';
        $result = $this->validator->validateFloat(8.5, $field);
        $this->assertEquals(8.5, $result);
    }

    /**
     * Test the validateFloat method with valid string numeric input.
     *
     * @return void
     */
    public function testValidateFloatWithStringNumericInput(): void
    {
        $field = 'rating';
        $result = $this->validator->validateFloat('8.5', $field);
        $this->assertEquals(8.5, $result);
    }

    /**
     * Test the validateFloat method with invalid input (not a float).
     *
     * @return void
     */
    public function testValidateFloatWithInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The rating must be a float.");
        $this->validator->validateFloat('abc', 'rating');
    }
}
