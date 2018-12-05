<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Types\CheckoutService\Response;

/**
 * Class Timeframe
 *
 * @package Dhl\ParcelManagement\Types
 */
class Timeframe
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
}
