<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Types\CheckoutService;

use Zend\Stdlib\JsonSerializable;

/**
 * Class Request
 *
 * @package Dhl\ParcelManagement\Types
 */
class Request
{
    /**
     * @var string
     */
    private $recipientZip;

    /**
     * @var string
     */
    public $startDate;

    /**
     * Request constructor.
     *
     * @param string $recipientZip
     * @param string $startDate
     */
    public function __construct(string $recipientZip, string $startDate)
    {
        $this->recipientZip = $recipientZip;
        $this->startDate = $startDate;
    }

    /**
     * @return string
     */
    public function getRecipientZip(): string
    {
        return $this->recipientZip;
    }
}
