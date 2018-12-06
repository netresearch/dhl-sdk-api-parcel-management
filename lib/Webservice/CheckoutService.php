<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice;

use Dhl\ParcelManagement\Exception\ApiException;
use Dhl\ParcelManagement\Types\CheckoutService\Response;
use Dhl\ParcelManagement\Webservice\Adapter\CheckoutServiceApiAdapter;
use Dhl\ParcelManagement\Webservice\CheckoutService\ResponseMapper;

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
     * @param  string $recipientZip
     * @param  string $startDate
     * @return Response
     * @throws ApiException
     */
    public function performAvailableServiceRequest(string $recipientZip, string $startDate): Response
    {
        try {
            $response = $this->adapter->getAvailableServices($recipientZip, $startDate);
            $responseMapper = new ResponseMapper();

            /** @var Response\AvailableServicesMap $availableServices */
            $availableServices = $responseMapper->map($response, Response\AvailableServicesMap::class);

            return new Response($availableServices);
        } catch (\Http\Client\Exception $exception) {
            throw new ApiException($exception->getMessage());
        } catch (\Exception $exception) {
            throw new ApiException($exception->getMessage());
        }
    }
}
