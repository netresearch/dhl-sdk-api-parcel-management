<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

class ServiceAvailable
{
    /**
     * @var bool
     */
    private $available;

    public function isAvailable(): bool
    {
        return $this->available;
    }
}
