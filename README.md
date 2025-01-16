# PHP Number and Word Formatter Library

This repository contains a set of PHP classes for formatting numbers and words. The three primary classes in this library include:

1. **MobileFormat**: A class for formatting phone numbers to a mobile-friendly format.
2. **NumberFormat**: A class for formatting numbers into human-readable formats, such as currency or percentages.
3. **WordFormatter**: A powerful class that converts numbers into words (e.g., 1234 to "one thousand two hundred thirty-four").

These classes are designed to help developers easily format numbers, phone numbers, and numbers into readable words for various applications.

## Features

- **MobileFormat Class**:
  - Easily format phone numbers to an international or local mobile format.
  - Supports validation of phone numbers for multiple regions.
  - Customizable formatting options based on your needs.

- **NumberFormat Class**:
  - Format numbers into human-readable formats (currency, percentages, etc.).
  - Supports localization for different formats (e.g., comma or period as decimal separator).
  - Round numbers based on custom decimal places.

- **WordFormatter Class**:
  - Convert numbers into words, including large numbers (e.g., 1 million, 1 billion, etc.).
  - Handles fractions and decimals, including proper word formatting for decimals (e.g., "point one" for 0.1).
  - Supports negative numbers and offers customization for output formatting.

## Installation

  - Download the files directly and include them in your project.
  - Please change the namespace of the files according to your base namespace class like ( in Laravel we have App )


## How To Use

### 1. **MobileFormat**
```php
use Codiexy\Services\MobileFormat; // replace this according to your project

$mobileFormatter = new MobileFormat("9834576312");
$formattedNumber = $mobileFormatter->format();
echo $formattedNumber; Output: +91 983-457-6312
```

### 2. **NumberFormat**
```php
use Codiexy\Services\NumberFormat; // replace this according to your project

$numberFormatter = new NumberFormat('123456.789');
$formattedNumber = $numberFormatter->format();
echo $formattedNumber;  // Output: 123,456.79
```

### 3. **WordFormatter**
```php
use Codiexy\Services\WordFormatter; // replace this according to your project

$wordFormatter = new WordFormatter(12345);
echo $wordFormatter->convert(12345);  // Output: Twelve Thousand Three Hundred Forty-Five
```
