<?php

declare(strict_types=1);

namespace ADS\ValueObjects\Implementation\String;

use ADS\ValueObjects\Exception\InvalidBase64EncodedStringException;
use function base64_decode;
use function base64_encode;

abstract class Base64EncodedStringValue extends StringValue
{
    /**
     * @return static
     */
    public static function fromPlainString(string $plainString)
    {
        return static::fromString(base64_encode($plainString));
    }

    public function toPlainString() : string
    {
        /** @var string|false $decoded */
        $decoded = base64_decode($this->toString());

        if ($decoded === false) {
            throw InvalidBase64EncodedStringException::couldNotDecode($this->toString(), static::class);
        }

        return $decoded;
    }
}