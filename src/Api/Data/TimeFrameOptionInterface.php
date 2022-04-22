<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api\Data;

/**
 * @api
 */
interface TimeFrameOptionInterface extends IntervalOptionInterface
{
    public function getCode(): string;
}
