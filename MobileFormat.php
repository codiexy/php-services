<?php
namespace Codiexy\Services;

class MobileFormat
{

    /**
     * Constructor to initialize the mobile number formatter.
     *
     * @param mixed $value The mobile number value.
     * @param string $countryCode The country code (default is '+91').
     * @param string $seperator The separator between the parts of the mobile number (default is '-').
     */
    public function __construct(
        protected mixed $value,
        protected string $countryCode = '+91',
        protected string $seperator = "-"
    ) {}

    /**
     * Format the mobile number with country code and standard spacing
     * Example: +1 123-456-7890
     */
    public function format(): string
    {
        // Remove non-numeric characters
        $cleanedNumber = preg_replace('/\D/', '', strval($this->value));

        // Validate that the number is at least 10 digits long
        if (strlen($cleanedNumber) < 10) {
            // throw new \InvalidArgumentException('Invalid mobile number: must contain at least 10 digits.');
            return "";
        }

        // Extract the last 10 digits for formatting
        $mainNumber = substr($cleanedNumber, -10);

        // Split into groups: 123-456-7890
        $formattedMain = substr($mainNumber, 0, 3) . $this->seperator . substr($mainNumber, 3, 3) . $this->seperator . substr($mainNumber, 6);

        // Prepend the country code
        return $this->countryCode . ' ' . $formattedMain;
    }

    /**
     * Override __toString to return mobile-specific format
     */
    public function __toString()
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
