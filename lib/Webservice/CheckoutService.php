<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice;

use Dhl\ParcelManagement\Exception\ApiException;
use Dhl\ParcelManagement\Exception\AuthenticationException;
use Dhl\ParcelManagement\Types\CheckoutService\Response;
use Dhl\ParcelManagement\Webservice\CheckoutService\ResponseMapper;
use Http\Client\Exception\HttpException;
use Http\Client\HttpClient;
use Http\Message\RequestFactory;

/**
 * Class CheckoutService
 *
 * @package Dhl\ParcelManagement\Webservice
 */
class CheckoutService
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
     * CheckoutService constructor.
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
     * @throws AuthenticationException
     */
    public function getAvailableServices(string $recipientZip, string $startDate): Response
    {
        try {
            $request = $this->requestFactory->createRequest('GET', $this->compileUri($recipientZip, $startDate));

            $response = $this->client->sendRequest($request);

            $responseMapper = new ResponseMapper();

            $jsonString = $response->getBody()->getContents();
            /** @var Response\AvailableServicesMap $availableServices */
            $availableServices = $responseMapper->map(
                $jsonString,
                Response\AvailableServicesMap::class
            );

            return new Response($availableServices);
        } catch (HttpException $exception) {
            if ($exception->getResponse()->getStatusCode() === 401) {
                throw new AuthenticationException($exception->getMessage(), $exception->getCode(), $exception);
            }
            throw new ApiException($exception->getMessage());
        } catch (\Http\Client\Exception $exception) {
            throw new ApiException($exception->getMessage());
        } catch (\Exception $exception) {
            throw new ApiException($exception->getMessage());
        }
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
