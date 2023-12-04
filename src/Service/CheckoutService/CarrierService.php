<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\CarrierServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Api\Data\IntervalOptionInterface;

class CarrierService implements CarrierServiceInterface
{
    /**
     * @param IntervalOptionInterface[] $options
     */
    public function __construct(
        private readonly string $code,
        private readonly bool $available,
        private readonly array $options = []
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @return IntervalOptionInterface[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
