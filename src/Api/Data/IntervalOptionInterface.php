<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api\Data;

/**
 * Interface IntervalOptionInterface
 *
 * @api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface IntervalOptionInterface
{
    /**
     * @return string
     */
    public function getStart(): string;

    /**
     * @return string
     */
    public function getEnd(): string;
}
