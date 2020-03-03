<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\IntervalOptionInterface;

/**
 * IntervalOption
 *
 * @author  Paul Siedler <paul.siedler@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class IntervalOption implements IntervalOptionInterface
{
    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $end;

    public function __construct(string $start, string $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function getStart(): string
    {
        return $this->start;
    }

    public function getEnd(): string
    {
        return $this->end;
    }
}
