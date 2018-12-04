<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice;

use Dhl\ParcelManagement\Types\CheckoutService\Request;
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
     * @param Request $request
     * @return Response
     * @throws \Http\Client\Exception
     */
    public function performRequest(Request $request): Response
    {
        return $this->adapter->getCheckoutServices($request);
    }
}
