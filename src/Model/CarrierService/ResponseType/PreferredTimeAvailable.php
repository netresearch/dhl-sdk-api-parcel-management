<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

/**
 * Class PreferredTimeAvailable
 *
 * @author  Max Melzer <max.melzer@netresearch.de>
 * @link    https://www.netresearch.de/
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
