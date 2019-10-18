<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Http;

use Dhl\Sdk\Paket\ParcelManagement\Api\CheckoutServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Api\ServiceFactoryInterface;
use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\CarrierServiceResponseMapper;
use Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\Authentication\BasicAuth;
use Http\Message\Formatter\FullHttpMessageFormatter;
use Psr\Log\LoggerInterface;

/**
 * Class HttpServiceFactory
 *
 * @package Dhl\Sdk\Paket\ParcelManagement\Http
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class HttpServiceFactory implements ServiceFactoryInterface
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * HttpServiceFactory constructor.
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Create the checkout service to retrieve applicable services and estimated delivery dates during checkout.
     *
     * @param string $appId
     * @param string $appToken
     * @param string $ekp
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     * @return CheckoutServiceInterface
     */
    public function createCheckoutService(
        string $appId,
        string $appToken,
        string $ekp,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): CheckoutServiceInterface {
        $authentication = new BasicAuth($appId, $appToken);

        $plugins = [
            new HeaderAppendPlugin([self::HEADER_X_EKP => $ekp]),
            new AuthenticationPlugin($authentication),
            new LoggerPlugin($logger, new FullHttpMessageFormatter(null)),
            new ErrorPlugin(),
        ];
        $client = new PluginClient($this->httpClient, $plugins);

        $jsonMapper = new \JsonMapper();
        $jsonMapper->bIgnoreVisibility = true;

        $baseUrl = $sandboxMode ? self::BASE_URL_SANDBOX : self::BASE_URL_PRODUCTION;
        $requestFactory = MessageFactoryDiscovery::find();

        $responseMapper = new CarrierServiceResponseMapper();

        return new CheckoutService($client, $baseUrl, $requestFactory, $jsonMapper, $responseMapper);
    }
}
