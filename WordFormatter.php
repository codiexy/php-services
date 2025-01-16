<?php
namespace Codiexy\Services;

class WordFormatter
{
    protected $dictionary = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        1000000 => 'million',
        1000000000 => 'billion',
        1000000000000 => 'trillion',
        1000000000000000 => 'quadrillion',
        1000000000000000000 => 'quintillion'
    ];

    protected $hyphen = '-';
    protected $conjunction = ' and ';
    protected $separator = ', ';
    protected $negative = 'negative ';
    protected $decimal = ' point ';
    protected $number;

    public function __construct($number = "")
    {
        // Validate input
        if (!is_numeric($number)) {
            throw new \Error("value must be numeric!");
        }
        $this->number = floatval($number);
    }

    /**
     * Convert number to words
     *
     * @param mixed $number
     * @return string|false
     */
    public function convert($number)
    {
        // Validate input
        if (!is_numeric($number)) {
            return false;
        }

        $this->number = floatval($number);

        // Handle negative numbers
        if ($number < 0) {
            return $this->negative . $this->convert(abs($number));
        }

        $string = null;
        $fraction = null;

        // Handle decimals
        if (strpos((string) $number, '.') !== false) {
            [$number, $fraction] = explode('.', (string) $number);
        }

        switch (true) {
            case $number < 21:
                $string = $this->dictionary[$number];
                break;

            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $this->dictionary[$tens];
                if ($units) {
                    $string .= $this->hyphen . $this->dictionary[$units];
                }
                break;

            case $number < 1000:
                $hundreds = (int) ($number / 100);
                $remainder = $number % 100;
                $string = $this->dictionary[$hundreds] . ' ' . $this->dictionary[100];
                if ($remainder) {
                    $string .= $this->conjunction . $this->convert($remainder);
                }
                break;

            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert($numBaseUnits) . ' ' . $this->dictionary[$baseUnit];
                if ($remainder) {
                    $string .= ($remainder < 100 ? $this->conjunction : $this->separator) . $this->convert($remainder);
                }
                break;
        }

        // Handle fractions
        if ($fraction !== null && is_numeric($fraction)) {
            $string .= $this->decimal;
            $words = [];
            foreach (str_split((string) $fraction) as $digit) {
                $words[] = $this->dictionary[$digit];
            }
            $string .= implode(' ', $words);
        }

        return capitalize_each_words($string);
    }

    /**
     * Override __toString to return mobile-specific format
     */
    public function __toString()
    {
        return $this->convert($this->number);
    }
}
