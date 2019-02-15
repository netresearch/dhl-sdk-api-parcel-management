<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Exception;

/**
 * Class ServiceException
 *
 * Generic SDK exception, can be used to catch any communication exception in
 * cases where the exact type does not matter.
 *
 * @api
 * @package Dhl\Sdk\Paket\ParcelManagement\Exception
 * @author  Max Melzer <max.melzer@netresearch.de>
 * @link    https://www.netresearch.de/
 */
abstract class ServiceException extends \Exception implements \Http\Client\Exception
{
}
