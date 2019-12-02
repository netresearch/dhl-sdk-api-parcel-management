<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api\Data;

/**
 * Interface CarrierServiceInterface
 *
 * @api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface CarrierServiceInterface
{
    /**
     * @return string
     */
    public function getCode(): string;

    /**
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * @return IntervalOptionInterface[]
     */
    public function getOptions(): array;
}
