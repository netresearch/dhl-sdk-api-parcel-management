<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice\Adapter;

use Dhl\ParcelManagement\Exception\ApiException;
use Dhl\ParcelManagement\Types\CheckoutService\Response;
use Dhl\ParcelManagement\Webservice\CheckoutService\ResponseMapper;
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
     * @param string $recipientZip
     * @param string $startDate
     * @return Response
     * @throws ApiException
     */
    public function getCheckoutServices(string $recipientZip, string $startDate): Response
    {
        $request = $this->requestFactory->createRequest('GET', $this->compileUri($recipientZip, $startDate));
        try {
            $response = $this->client->sendRequest($request);
        } catch (\Http\Client\Exception $exception) {
            throw new ApiException($exception->getMessage());
        } catch (\Exception $exception) {
            throw new ApiException($exception->getMessage());
        }

        try {
            $mappedResponse = (new ResponseMapper())->map($response);
        } catch (\JsonMapper_Exception $exception) {
            throw new ApiException($exception->getMessage());
        }

        return $mappedResponse;
    }

    /**
     * @param string $recipientZip
     * @param string $startDate
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
