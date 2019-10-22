<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service;

use Dhl\Sdk\Paket\ParcelManagement\Api\CheckoutServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Api\Data\CarrierServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Exception\AuthenticationException;
use Dhl\Sdk\Paket\ParcelManagement\Exception\ClientException;
use Dhl\Sdk\Paket\ParcelManagement\Exception\ServerException;
use Dhl\Sdk\Paket\ParcelManagement\Exception\ServiceException;
use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\CarrierServiceResponseMapper;
use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType\AvailableServicesMap;
use Http\Client\Common\Exception\ClientErrorException;
use Http\Client\Exception as HttpClientException;
use Http\Client\HttpClient;
use Http\Message\RequestFactory;

/**
 * CheckoutService
 *
 * Entrypoint for DHL Paket Parcel Management checkout operations.
 *
 * @package Dhl\Sdk\Paket\ParcelManagement\Service
 * @author  Paul Siedler <paul.siedler@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class CheckoutService implements CheckoutServiceInterface
{
    const RESOURCE = 'checkout';

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var \JsonMapper
     */
    private $jsonMapper;

    /**
     * @var CarrierServiceResponseMapper
     */
    private $responseMapper;

    /**
     * CheckoutService constructor.
     * @param HttpClient $client
     * @param string $baseUrl
     * @param RequestFactory $requestFactory
     * @param \JsonMapper $jsonMapper
     * @param CarrierServiceResponseMapper $responseMapper
     */
    public function __construct(
        HttpClient $client,
        string $baseUrl,
        RequestFactory $requestFactory,
        \JsonMapper $jsonMapper,
        CarrierServiceResponseMapper $responseMapper
    ) {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
        $this->requestFactory = $requestFactory;
        $this->jsonMapper = $jsonMapper;
        $this->responseMapper = $responseMapper;
    }

    /**
     * Obtain a list of available services for the given postal code and date.
     *
     * @param string $recipientZip
     * @param \DateTime $startDate
     * @param string[] $headers
     *
     * @return CarrierServiceInterface[]
     *
     * @throws ServiceException
     */
    public function getCarrierServices(
        string $recipientZip,
        \DateTime $startDate,
        array $headers = []
    ): array {
        $headers['Accept'] = 'application/json';
        $requestParams = ['startDate' => $startDate->format('Y-m-d')];

        $uri = sprintf(
            '%s%s/%s/availableServices?%s',
            $this->baseUrl,
            self::RESOURCE,
            $recipientZip,
            http_build_query($requestParams)
        );

        try {
            $httpRequest = $this->requestFactory->createRequest('GET', $uri);
            foreach ($headers as $key => $value) {
                $httpRequest = $httpRequest->withHeader($key, $value);
            }

            $response = $this->client->sendRequest($httpRequest);
            $responseJson = (string)$response->getBody();

            /** @var AvailableServicesMap $servicesResponse */
            $servicesResponse = $this->jsonMapper->map(\json_decode($responseJson), new AvailableServicesMap());
        } catch (\JsonMapper_Exception $exception) {
            throw ClientException::create($exception);
        } catch (ClientErrorException $exception) {
            throw ClientException::create($exception);
        } catch (HttpClientException $exception) {
            throw ServerException::httpClientException($exception);
        } catch (\Exception $exception) {
            throw ServerException::create($exception);
        }

        return $this->responseMapper->map($servicesResponse);
    }
}
