<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\AreaTimeFrameOptionInterface;

/**
 * AreaTimeFrameOption
 *
 * @author  Paul Siedler <paul.siedler@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class AreaTimeFrameOption implements AreaTimeFrameOptionInterface
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

    public function __construct(
        string $start,
        string $end,
        string $code,
        string $denselyPopulatedAreaId,
        string $denselyPopulatedAreaName,
        string $deliveryBaseId
    ) {
        $this->start = $start;
        $this->end = $end;
        $this->code = $code;
        $this->denselyPopulatedAreaId = $denselyPopulatedAreaId;
        $this->denselyPopulatedAreaName = $denselyPopulatedAreaName;
        $this->deliveryBaseId = $deliveryBaseId;
    }

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
