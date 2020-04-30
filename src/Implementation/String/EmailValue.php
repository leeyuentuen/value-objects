<?php

declare(strict_types=1);

namespace ADS\ValueObjects\Implementation\String;

use RuntimeException;
use function filter_var;
use function idn_to_ascii;
use function sprintf;
use const FILTER_VALIDATE_EMAIL;
use const IDNA_DEFAULT;
use const INTL_IDNA_VARIANT_UTS46;

abstract class EmailValue extends StringValue
{
    protected function __construct(string $value)
    {
        $email = idn_to_ascii($value, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);

        if ($email === false) {
            throw new RuntimeException(
                sprintf(
                    'Could not convert e-mail \'%s\' to IDNA ASCII form',
                    $value
                )
            );
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException(
                sprintf(
                    '\'%s\' is not a valid e-mail for value object \'%s\'.',
                    $value,
                    static::class
                )
            );
        }

        parent::__construct($email);
    }
}
