<?php

namespace Codiexy\Services;

use JsonSerializable;

class NumberFormat implements JsonSerializable
{
    protected float $value;

    /**
     * Constructor to initialize the number format object.
     *
     * @param mixed $num The number to be formatted.
     * @param int $decimals The number of decimal points (default is 2).
     * @param string|null $decimal_separator The character used as decimal separator (default is '.').
     * @param string|null $thousands_separator The character used as thousands separator (default is ',').
     */
    public function __construct(
        mixed $num,
        protected int $decimals = 2,
        protected ?string $decimal_separator = '.',
        protected ?string $thousands_separator = ','
    ) {
        $this->value = floatval($num);
    }

    /**
     * Format the number according to the given settings.
     *
     * @param int|null $decimals The number of decimal points to use.
     * @return string The formatted number.
     */
    public function format($decimals = null): string
    {
        return number_format(
            $this->value,
            is_null($decimals) ? $this->decimals : intval($decimals),
            $this->decimal_separator,
            $this->thousands_separator
        );
    }

    /**
     * Get the raw value of the number.
     *
     * @return float The raw value.
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Return the formatted number as a string.
     *
     * @return string The formatted number.
     */
    public function __toString(): string
    {
        return $this->format();
    }

    /**
     * Convert the object to a JSON-friendly value.
     *
     * @return string The formatted number.
     */
    public function jsonSerialize(): string
    {
        return $this->format();
    }
}
