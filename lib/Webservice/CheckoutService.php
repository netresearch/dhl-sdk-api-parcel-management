<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice;

use Dhl\ParcelManagement\Exception\ApiException;
use Dhl\ParcelManagement\Types\CheckoutService\Response;
use Dhl\ParcelManagement\Webservice\Adapter\CheckoutServiceApiAdapter;

/**
 * Class CheckoutService
 *
 * @package Dhl\ParcelManagement\Webservice
 */
class CheckoutService
{
    /**
     * @var CheckoutServiceApiAdapter
     */
    private $adapter;

    /**
     * CheckoutService constructor.
     *
     * @param CheckoutServiceApiAdapter $adapter
     */
    public function __construct(CheckoutServiceApiAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $recipientZip
     * @param string $startDate
     * @return Response
     * @throws ApiException
     */
    public function performRequest(string $recipientZip, string $startDate): Response
    {
        return $this->adapter->getCheckoutServices($recipientZip, $startDate);
    }
}
