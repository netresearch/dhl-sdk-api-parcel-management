<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

/**
 * Class SameDayDeliveryAvailable
 *
 * @author  Max Melzer <max.melzer@netresearch.de>
 * @link    https://www.netresearch.de/
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
