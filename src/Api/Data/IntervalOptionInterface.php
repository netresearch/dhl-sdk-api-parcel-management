<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api\Data;

/**
 * @api
 */
interface IntervalOptionInterface
{
    public function getStart(): string;

    public function getEnd(): string;
}
