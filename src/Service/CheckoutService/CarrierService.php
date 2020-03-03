<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\CarrierServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Api\Data\IntervalOptionInterface;

/**
 * CarrierService
 *
 * @author  Paul Siedler <paul.siedler@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class CarrierService implements CarrierServiceInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var bool
     */
    private $available;

    /**
     * @var IntervalOptionInterface[]
     */
    private $options;

    /**
     * CarrierService constructor.
     *
     * @param string $code
     * @param bool $available
     * @param IntervalOptionInterface[] $options
     */
    public function __construct(string $code, bool $available, array $options = [])
    {
        $this->code = $code;
        $this->available = $available;
        $this->options = $options;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @return IntervalOptionInterface[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
