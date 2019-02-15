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
 * @package Dhl\Sdk\Paket\ParcelManagement\Api\Data
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface AreaTimeFrameOptionInterface extends TimeFrameOptionInterface
{
    /**
     * @return string
     */
    public function getDenselyPopulatedAreaId(): string;

    /**
     * @return string
     */
    public function getDenselyPopulatedAreaName(): string;

    /**
     * @return string
     */
    public function getDeliveryBaseId(): string;
}
