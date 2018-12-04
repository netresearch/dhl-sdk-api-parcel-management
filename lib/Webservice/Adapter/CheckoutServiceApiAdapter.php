<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice\Adapter;

use Dhl\ParcelManagement\Types\CheckoutService\Request;
use Dhl\ParcelManagement\Types\CheckoutService\Response;
use Http\Client\HttpClient;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\RequestFactory;
use http\Url;

/**
 * Class CheckoutServiceApiAdapter
 *
 * @package Dhl\ParcelManagement\Webservice
 */
class CheckoutServiceApiAdapter
{
    const RESOURCE = '/checkout/{recipientZip}/availableServices';

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * CheckoutServiceApiAdapter constructor.
     *
     * @param string $baseUrl
     * @param RequestFactory $requestFactory
     * @param HttpClient $client
     */
    public function __construct(string $baseUrl, RequestFactory $requestFactory, HttpClient $client)
    {
        $this->baseUrl = $baseUrl;
        $this->requestFactory = $requestFactory;
        $this->client = $client;
    }

    /**
     * @param Request $getServicesRequest
     * @return Response
     * @throws \Http\Client\Exception
     */
    public function getCheckoutServices(Request $getServicesRequest): Response
    {
        $uri = $this->baseUrl . self::RESOURCE;
        $uri = str_replace('{recipientZip}', $getServicesRequest->getRecipientZip(), $uri);
        $uri .= '?' . http_build_query((array)$getServicesRequest);

        $request = $this->requestFactory->createRequest(
            'GET',
            $uri
        );
        $response = $this->client->sendRequest($request);

        // @TODO convert $response contents into PHP object
        $createLabelResponse = new Response();

        return $createLabelResponse;
    }
}
