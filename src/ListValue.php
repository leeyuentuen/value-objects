<?php

declare(strict_types=1);

namespace ADS\ValueObjects;

use Closure;
use Countable;
use EventEngine\Schema\TypeSchema;
use Throwable;

interface ListValue extends ValueObject, Countable
{
    /**
     * @return class-string
     */
    public static function itemType(): string;

    /**
     * This returns a closure that will get an item as argument
     * and returns the identifier of that item.
     */
    public static function itemIdentifier(): Closure;

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public static function fromScalarToItem($value);

    /**
     * @param mixed $item
     *
     * @return mixed
     */
    public static function fromItemToScalar($item);

    /**
     * @param array<mixed> $value
     *
     * @return static
     */
    public static function fromArray(array $value);

    /**
     * @param array<mixed> $values
     *
     * @return static
     */
    public static function fromItems(array $values);

    /**
     * @return static
     */
    public static function emptyList();

    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @return array<mixed>
     */
    public function toItems(): array;

    /**
     * @param mixed $item
     *
     * @return static
     */
    public function push($item);

    /**
     * @param ValueObject|string|int|null $key
     * @param mixed $item
     *
     * @return static
     */
    public function put($item, $key = null);

    /**
     * @return static
     */
    public function pop();

    /**
     * @return static
     */
    public function shift();

    /**
     * @param mixed $item
     *
     * @return static
     */
    public function unshift($item);

    /**
     * @param ValueObject|string|int $key
     *
     * @return static
     */
    public function forget($key);

    /**
     * @return static
     */
    public function diffByKeys(ListValue $keys);

    /**
     * @param ValueObject|string|int $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @return static
     */
    public function getByKeys(ListValue $keys);

    /**
     * @param ValueObject|string|int $key
     */
    public function has($key): bool;

    /**
     * @param mixed $item
     */
    public function contains($item): bool;

    /**
     * @param mixed $item
     * @param string|int|null $default
     *
     * @return string|int|null
     */
    public function keyByItem($item, $default = null);

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function first($default = null);

    /**
     * @return mixed
     */
    public function needFirst(Throwable $exception);

    /**
     * @param string|int|null $default
     *
     * @return string|int|null
     */
    public function firstKey($default = null);

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function last($default = null);

    /**
     * @param string|int|null $default
     *
     * @return string|int|null
     */
    public function lastKey($default = null);

    /**
     * @return static
     */
    public function filter(Closure $closure, bool $resetKeys = false);

    public function isEmpty(): bool;

    public function implode(string $glue): string;

    /**
     * @return static
     */
    public function unique();

    public static function containsType(): ?TypeSchema;

    public static function minItems(): ?int;

    public static function maxItems(): ?int;

    public static function uniqueItems(): ?bool;
}
