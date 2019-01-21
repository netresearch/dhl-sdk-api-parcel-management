<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Types\CheckoutService\Response;

/**
 * Class PreferredDayAvailable
 *
 * @package Dhl\ParcelManagement\Types
 */
class PreferredDayAvailable
{
    /**
     * @var bool
     */
    private $available;

    /**
     * @var TimeInterval[]
     */
    private $validDays;

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @return TimeInterval[]
     */
    public function getValidDays(): array
    {
        return $this->validDays;
    }
}
