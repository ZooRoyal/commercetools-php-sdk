<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#delivery
 * @method Delivery current()
 * @method DeliveryCollection add(Delivery $element)
 * @method Delivery getAt($offset)
 * @method Delivery getById($offset)
 */
class DeliveryCollection extends Collection
{
    protected $type = Delivery::class;

    protected function indexRow($offset, $row)
    {
        $id = null;
        if ($row instanceof Delivery) {
            $id = $row->getId();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }
}
