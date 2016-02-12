<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\TaxCategories\Command
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#remove-tax-rate
 * @method string getAction()
 * @method TaxCategoryRemoveTaxRateAction setAction(string $action = null)
 * @method string getTaxRateId()
 * @method TaxCategoryRemoveTaxRateAction setTaxRateId(string $taxRateId = null)
 * @method string getRateId()
 * @method TaxCategoryRemoveTaxRateAction setRateId(string $rateId = null)
 */
class TaxCategoryRemoveTaxRateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'rateId' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeTaxRate');
    }

    /**
     * @param string $taxRateId
     * @param Context|callable $context
     * @return TaxCategoryRemoveTaxRateAction
     */
    public static function ofTaxRateId($taxRateId, $context = null)
    {
        return static::of($context)->setRateId($taxRateId);
    }
}
