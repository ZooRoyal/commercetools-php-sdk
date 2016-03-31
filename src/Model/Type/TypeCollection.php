<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#type
 * @method Type current()
 * @method TypeCollection add(Type $element)
 * @method Type getAt($offset)
 */
class TypeCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Type\Type';
}