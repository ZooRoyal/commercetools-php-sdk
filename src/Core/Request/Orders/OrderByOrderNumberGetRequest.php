<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Orders
 * @link https://docs.commercetools.com/http-api-projects-orders.html#get-order-by-ordernumber
 * @method Order mapResponse(ApiResponseInterface $response)
 * @method Order mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderByOrderNumberGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Order::class;

    /**
     * @param string $orderNumber
     * @param Context $context
     */
    public function __construct($orderNumber, Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $orderNumber, $context);
    }

    /**
     * @param string $orderNumber
     * @param Context $context
     * @return static
     */
    public static function ofOrderNumber($orderNumber, Context $context = null)
    {
        return new static($orderNumber, $context);
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->getId();
    }

    /**
     * @param string $orderNumber
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        return $this->setId($orderNumber);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/order-number=' . urlencode($this->getId()) . $this->getParamString();
    }
}
