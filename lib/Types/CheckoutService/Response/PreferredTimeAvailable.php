<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Types\CheckoutService\Response;

/**
 * Class PreferredTimeAvailable
 *
 * @package Dhl\ParcelManagement\Types
 */
class PreferredTimeAvailable
{
    /**
     * @var bool
     */
    private $available;

    /**
     * @var Timeframe[]
     */
    private $timeFrames;

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @return Timeframe[]
     */
    public function getTimeFrames(): array
    {
        return $this->timeFrames;
    }
}
