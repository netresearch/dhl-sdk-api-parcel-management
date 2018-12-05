<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Types\CheckoutService\Response;

/**
 * Class SameDayDeliveryAvailable
 *
 * @package Dhl\ParcelManagement\Types
 */
class SameDayDeliveryAvailable
{
    /**
     * @var bool
     */
    private $available;

    /**
     * @var SameDayTimeframe[]
     */
    private $sameDayTimeframes;

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @return SameDayTimeframe[]
     */
    public function getSameDayTimeframes(): array
    {
        return $this->sameDayTimeframes;
    }
}
