<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Types\CheckoutService\Response;

/**
 * Class SameDayTimeframe
 *
 * @package Dhl\ParcelManagement\Types
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

    /**
     * @return string
     */
    public function getStart(): string
    {
        return $this->start;
    }

    /**
     * @return string
     */
    public function getEnd(): string
    {
        return $this->end;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getDenselyPopulatedAreaId(): string
    {
        return $this->denselyPopulatedAreaId;
    }

    /**
     * @return string
     */
    public function getDenselyPopulatedAreaName(): string
    {
        return $this->denselyPopulatedAreaName;
    }

    /**
     * @return string
     */
    public function getDeliveryBaseId(): string
    {
        return $this->deliveryBaseId;
    }
}
