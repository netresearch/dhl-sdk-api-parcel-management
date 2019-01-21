<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice;

use Dhl\ParcelManagement\Api\ServiceFactoryInterface;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClient;
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
     * @inheritdoc
     */
    public function createCheckoutService(
        string $appId,
        string $appToken,
        string $ekp,
        LoggerInterface $logger,
        bool $isSandboxMode = true
    ): CheckoutService {
        $authentication = new BasicAuth($appId, $appToken);

        $pluginClient = new PluginClient(
            HttpClientDiscovery::find(),
            [
                new HeaderAppendPlugin([self::HEADER_X_EKP => $ekp]),
                new AuthenticationPlugin($authentication),
                new LoggerPlugin($logger),
                new ErrorPlugin(),
            ]
        );

        return new CheckoutService(
            $isSandboxMode ? self::BASE_URL_SANDBOX : self::BASE_URL_PRODUCTION,
            MessageFactoryDiscovery::find(),
            $pluginClient
        );
    }
}
