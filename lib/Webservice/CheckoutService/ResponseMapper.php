<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice\CheckoutService;

use Dhl\ParcelManagement\Types\CheckoutService\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseMapper
 *
 * @package Dhl\ParcelManagement\Webservice
 */
class ResponseMapper
{
    /**
     * @param ResponseInterface $response
     * @return Response
     * @throws \JsonMapper_Exception
     */
    public function map(ResponseInterface $response): Response
    {
        $jsonMapper = new \JsonMapper();
        $jsonMapper->bIgnoreVisibility = true;

        $jsonData = \json_decode($response->getBody()->getContents());
        $availableServicesMap = $jsonMapper->map($jsonData, new Response\AvailableServicesMap());

        return new Response($availableServicesMap);
    }
}
