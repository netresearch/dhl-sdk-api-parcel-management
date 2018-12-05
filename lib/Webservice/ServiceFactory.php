<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice;

use Dhl\ParcelManagement\Api\ServiceFactoryInterface;
use Dhl\ParcelManagement\Webservice\Adapter\CheckoutServiceApiAdapter;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\Exception\NotFoundException;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\Authentication\BasicAuth;
use Psr\Log\LoggerInterface;

/**
 * Class ServiceFactory
 *
 * @package Dhl\ParcelManagement\Webservice
 */
class ServiceFactory implements ServiceFactoryInterface
{
    /**
     * @param string $appId
     * @param string $appToken
     * @param string $ekp
     * @param LoggerInterface $logger
     * @param HttpClient|null $client
     * @param string $baseUrl
     * @return CheckoutService
     * @throws NotFoundException
     */
    public function createCheckoutService(
        string $appId,
        string $appToken,
        string $ekp,
        LoggerInterface $logger,
        string $baseUrl = self::BASE_URL_SANDBOX,
        HttpClient $client = null
    ): CheckoutService {
        $client = $this->getClient($client);

        $authentication = new BasicAuth($appId, $appToken);
        
        $pluginClient = new PluginClient(
            $client,
            [
                new HeaderAppendPlugin([self::HEADER_X_EKP => $ekp]),
                new AuthenticationPlugin($authentication),
                new LoggerPlugin($logger),
                new ErrorPlugin(),
            ]
        );

        $adapter = new CheckoutServiceApiAdapter(
            $baseUrl,
            MessageFactoryDiscovery::find(),
            $pluginClient
        );

        return new CheckoutService($adapter);
    }

    /**
     * @param HttpClient|null $client
     * @return HttpClient
     * @throws NotFoundException
     */
    private function getClient(HttpClient $client = null): HttpClient
    {
        return $client ?: HttpClientDiscovery::find();
    }
}
