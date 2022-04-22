<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api\Data;

/**
 * @api
 */
interface CarrierServiceInterface
{
    public function getCode(): string;

    public function isAvailable(): bool;

    /**
     * @return IntervalOptionInterface[]
     */
    public function getOptions(): array;
}
