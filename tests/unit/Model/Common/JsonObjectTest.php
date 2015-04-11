<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:24
 */

namespace Sphere\Core\Model\Type;


use Sphere\Core\Model\Common\JsonObject;

/**
 * Class JsonObjectTest
 * @package Sphere\Core\Model\Type
 */
class JsonObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return JsonObject
     */
    protected function getObject()
    {
        date_default_timezone_set('UTC');
        $obj = $this->getMock(
            '\Sphere\Core\Model\Common\JsonObject',
            ['getFields'],
            [['key' => 'value', 'true' => true, 'false' => false]]
        );
        $obj->expects($this->any())
            ->method('getFields')
            ->will(
                $this->returnValue(
                    [
                        'key' => [JsonObject::TYPE => 'string'],
                        'dummy' => [JsonObject::TYPE => 'string'],
                        'true' => [JsonObject::TYPE => 'bool'],
                        'false' => [JsonObject::TYPE => 'bool'],
                        'localString' => [JsonObject::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
                        'mixed' => [],
                        'decorator' => [
                            JsonObject::TYPE => '\DateTime',
                            JsonObject::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
                        ]
                    ]
                )
            );

        return $obj;
    }

    public function testToArray()
    {
        $this->assertSame(['key' => 'value', 'true' => true, 'false' => false], $this->getObject()->toArray());
    }

    public function testSerializable()
    {
        $this->assertSame(['key' => 'value', 'true' => true, 'false' => false], $this->getObject()->jsonSerialize());
    }

    public function testInterface()
    {
        $this->assertInstanceOf('\JsonSerializable', $this->getObject());
    }

    public function testGet()
    {
        $this->assertSame('value', $this->getObject()->getKey());
    }

    public function testSet()
    {
        $this->assertSame('newValue', $this->getObject()->setKey('newValue')->getKey());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWrongType()
    {
        $this->getObject()->setKey(1);
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testGetUnknownField()
    {
        $this->getObject()->getUnknown();
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testSetUnknownField()
    {
        $this->getObject()->setUnknown('unknown');
    }

    public function testGetFields()
    {
        $obj = new JsonObject();
        $this->assertSame([], $obj->getFields());
    }

    public function testConstruct()
    {
        $obj = new JsonObject(['key' => 'value']);
        $this->assertSame(['key' => 'value'], $obj->toArray());
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testUnknownAction()
    {
        $this->getObject()->hasKey();
    }

    public function testNotTyped()
    {
        $this->assertSame(1.5, $this->getObject()->setMixed(1.5)->getMixed());
    }

    public function testOf()
    {
        $this->assertInstanceOf('\Sphere\Core\Model\Common\JsonObject', JsonObject::of());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetNull()
    {
        $this->getObject()->setKey(null);
    }

    public function testInitialize()
    {
        $obj = $this->getObject();
        $obj->setRawData(['localString' => ['en' => 'test']]);
        $this->assertInstanceOf('\Sphere\Core\Model\Common\LocalizedString', $obj->getLocalString());
    }

    public function testMappedToArray()
    {
        $obj = $this->getObject();
        $obj->setRawData(['localString' => ['en' => 'test']]);
        $obj->getLocalString()->add('en', 'newValue');

        $json = json_encode($obj);
        $this->assertSame('{"localString":{"en":"newValue"}}', $json);
    }

    public function testFromArray()
    {
        $obj = JsonObject::fromArray(['key' => 'value']);
        $this->assertInstanceOf('\Sphere\Core\Model\Common\JsonObject', $obj);
    }

    public function testGetReturnRaw()
    {
        $obj = $this->getMock('\Sphere\Core\Model\Common\JsonObject', ['initialize'], [['key' => 'value']]);
        $this->assertSame('value', $obj->get('key'));
    }

    public function testDecorated()
    {
        $obj = $this->getObject();
        $obj->setRawData(['decorator' => new \DateTime('2015-10-15 15:16:32')]);
        $this->assertInstanceOf('\Sphere\Core\Model\Common\DateTimeDecorator', $obj->getDecorator());
    }

    public function testDecoratedString()
    {
        $obj = $this->getObject();
        $obj->setRawData(['decorator' => new \DateTime('2015-10-15 15:16:32')]);
        $this->assertSame('"2015-10-15T15:16:32+00:00"', json_encode($obj->getDecorator()));
    }

    public function testSetDecorator()
    {
        $obj = $this->getObject();
        $obj->setDecorator(new \DateTime());
        $this->assertInstanceOf('\Sphere\Core\Model\Common\DateTimeDecorator', $obj->getDecorator());
    }
}