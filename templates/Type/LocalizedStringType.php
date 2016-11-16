<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Templates\Type;

class LocalizedStringType extends FieldType
{
    public function __construct(array $data)
    {
        $data['name'] = 'LocalizedString';
        parent::__construct($data);
    }
}
