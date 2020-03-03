<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api\Data;

/**
 * Interface AreaTimeFrameOptionInterface
 *
 * @api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface AreaTimeFrameOptionInterface extends TimeFrameOptionInterface
{
    public function getDenselyPopulatedAreaId(): string;

    public function getDenselyPopulatedAreaName(): string;

    public function getDeliveryBaseId(): string;
}
