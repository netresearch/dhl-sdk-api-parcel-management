<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api\Data;

/**
 * @api
 */
interface AreaTimeFrameOptionInterface extends TimeFrameOptionInterface
{
    public function getDenselyPopulatedAreaId(): string;

    public function getDenselyPopulatedAreaName(): string;

    public function getDeliveryBaseId(): string;
}
