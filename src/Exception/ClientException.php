<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Exception;

/**
 * Class ClientException
 *
 * @api
 * @package Dhl\Sdk\Paket\ParcelManagement\Exception
 * @author  Max Melzer <max.melzer@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ClientException extends ServiceException
{
    /**
     * Create client exception in cases where response body could not be unserialized into PHP objects.
     *
     * @param \JsonMapper_Exception $exception
     * @return ClientException
     */
    public static function schemaException(\JsonMapper_Exception $exception)
    {
        return new static('An error occurred during response parsing.', $exception->getCode(), $exception);
    }

    /**
     * Create client exception.
     *
     * @param \Exception $exception
     * @return AuthenticationException|ClientException
     */
    public static function create(\Exception $exception)
    {
        if ($exception->getCode() === 401) {
            return new AuthenticationException('Authentication failed.', $exception->getCode(), $exception);
        }

        return new self($exception->getMessage(), $exception->getCode(), $exception);
    }
}
