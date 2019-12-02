<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api\Data;

/**
 * Interface TimeFrameOptionInterface
 *
 * @api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface TimeFrameOptionInterface extends IntervalOptionInterface
{
    /**
     * @return string
     */
    public function getCode(): string;
}
