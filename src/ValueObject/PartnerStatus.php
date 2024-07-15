<?php

declare(strict_types=1);

namespace ProjetNormandie\PartnerBundle\ValueObject;

use Webmozart\Assert\Assert;

class PartnerStatus
{
    public const ACTIVE = 'ACTIVE';
    public const INACTIVE = 'INACTIVE';

    public const VALUES = [
        self::ACTIVE,
        self::INACTIVE
    ];

    private string $value;

    public function __construct(string $value)
    {
        self::inArray($value);

        $this->value = $value;
    }

    public static function inArray(string $value): void
    {
        Assert::inArray($value, self::VALUES);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isActive(): bool
    {
        return $this->value === self::ACTIVE;
    }

    public function isInactive(): bool
    {
        return $this->value === self::INACTIVE;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return string[]
     */
    public static function getStatusChoices(): array
    {
        return [
            self::ACTIVE => self::ACTIVE,
            self::INACTIVE => self::INACTIVE
        ];
    }
}
