<?php

declare(strict_types=1);

namespace ADS\ValueObjects\Implementation\Float;

use ADS\ValueObjects\FloatValue as FloatValueInterface;

use function floatval;

abstract class FloatValue implements FloatValueInterface
{
    protected float $value;

    protected function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public static function fromFloat(float $value)
    {
        return new static($value);
    }

    public function toFloat(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return '' . $this->toFloat();
    }

    /**
     * @inheritDoc
     */
    public function toValue()
    {
        return $this->toFloat();
    }

    /**
     * @inheritDoc
     */
    public static function fromValue($value)
    {
        return static::fromFloat(floatval($value));
    }

    /**
     * @inheritDoc
     */
    public function isEqualTo($other): bool
    {
        if (! $other instanceof self) {
            return false;
        }

        return $this->toFloat() === $other->toFloat();
    }
}
