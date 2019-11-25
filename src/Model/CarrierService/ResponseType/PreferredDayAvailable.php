<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

/**
 * Class PreferredDayAvailable
 *
 * @author  Max Melzer <max.melzer@netresearch.de>
 * @link    https://www.netresearch.de/
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
