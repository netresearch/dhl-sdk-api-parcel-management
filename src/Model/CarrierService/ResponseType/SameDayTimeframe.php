<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

/**
 * Class SameDayTimeframe
 *
 * @author  Max Melzer <max.melzer@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class SameDayTimeframe
{
    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $end;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $denselyPopulatedAreaId;

    /**
     * @var string
     */
    private $denselyPopulatedAreaName;

    /**
     * @var string
     */
    private $deliveryBaseId;

    public function getStart(): string
    {
        return $this->start;
    }

    public function getEnd(): string
    {
        return $this->end;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDenselyPopulatedAreaId(): string
    {
        return $this->denselyPopulatedAreaId;
    }

    public function getDenselyPopulatedAreaName(): string
    {
        return $this->denselyPopulatedAreaName;
    }

    public function getDeliveryBaseId(): string
    {
        return $this->deliveryBaseId;
    }
}
