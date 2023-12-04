<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service;

use Dhl\Sdk\Paket\ParcelManagement\Api\CheckoutServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Exception\ServiceExceptionFactory;
use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\CarrierServiceResponseMapper;
use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType\AvailableServicesMap;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class CheckoutService implements CheckoutServiceInterface
{
    private const RESOURCE = 'checkout';

    public function __construct(
        private readonly ClientInterface $client,
        private readonly string $baseUrl,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly \JsonMapper $jsonMapper,
        private readonly CarrierServiceResponseMapper $responseMapper
    ) {
    }

    public function getCarrierServices(
        string $recipientZip,
        \DateTimeInterface $startDate,
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
            $servicesResponse = $this->jsonMapper->map(
                \json_decode($responseJson, null, 512, JSON_THROW_ON_ERROR),
                new AvailableServicesMap()
            );
        } catch (ClientExceptionInterface $exception) {
            if ($exception->getCode() === 401) {
                throw ServiceExceptionFactory::createAuthenticationException($exception);
            }
            throw ServiceExceptionFactory::createServiceException($exception);
        } catch (\Throwable $exception) {
            if ($exception->getCode() === 401) {
                throw ServiceExceptionFactory::createAuthenticationException($exception);
            }
            throw ServiceExceptionFactory::create($exception);
        }

        return $this->responseMapper->map($servicesResponse);
    }
}
