<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice\Adapter;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;

/**
 * Class CheckoutServiceApiAdapter
 *
 * @package Dhl\ParcelManagement\Webservice
 */
class CheckoutServiceApiAdapter
{
    const RESOURCE = 'checkout/{recipientZip}/availableServices';

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
     * Fetch available value added services for postcode and start date
     *
     * @param string $recipientZip
     * @param string $startDate
     * @return string
     * @throws \Http\Client\Exception
     */
    public function getAvailableServices(string $recipientZip, string $startDate): string
    {
        $request = $this->requestFactory->createRequest('GET', $this->compileUri($recipientZip, $startDate));

        $response = $this->client->sendRequest($request);

        return $response->getBody()->getContents();
    }

    /**
     * @param  string $recipientZip
     * @param  string $startDate
     * @return string
     */
    private function compileUri(string $recipientZip, string $startDate): string
    {
        $uri = $this->baseUrl . self::RESOURCE;
        $uri = str_replace('{recipientZip}', $recipientZip, $uri);
        $uri .= '?' . http_build_query(['startDate' => $startDate]);

        return $uri;
    }
}
