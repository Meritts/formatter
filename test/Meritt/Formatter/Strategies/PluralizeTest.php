<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kaleu
 * Date: 11/09/13
 * Time: 17:01
 * To change this template use File | Settings | File Templates.
 */

namespace Meritt\Formatter\Strategies;


use \InvalidArgumentException;

class PluralizeTest extends \PHPUnit_Framework_TestCase {

    public static function invalidStrings()
    {
        return [
            [''],
            [null],
            [[]],
            [new \stdClass()],
            [1234],
            [false]
        ];
    }

    /**
     * @test
     * @dataProvider invalidStrings
     * @expectedException InvalidArgumentException
     */
    public function zeroFormatMessageShouldBeANonEmptyString($invalidValue)
    {
        $object = new Pluralize($invalidValue, 'test', 'test');
    }

    /**
     * @test
     * @dataProvider invalidStrings
     * @expectedException InvalidArgumentException
     */
    public function singularFormatMessageShouldBeANonEmptyString($invalidValue)
    {
        $object = new Pluralize('test', $invalidValue, 'test');
    }

    /**
     * @test
     * @dataProvider invalidStrings
     * @expectedException InvalidArgumentException
     */
    public function pluralFormatMessageShouldBeANonEmptyString($invalidValue)
    {
        $object = new Pluralize('test', 'test', $invalidValue);
    }

    /**
     * @test
     */
    public function formatWithPluralCountMustBeReturnThePluralFormatMessage()
    {
        $number = $this->getMock('Meritt\Formatter\Strategies\Number');
        $number->expects($this->any())
          ->method('format')
          ->will($this->returnValue('3.145'));

        $object = new Pluralize('test', 'test', '%s alunos', $number);
        $this->assertEquals('3.145 alunos', $object->format(3145));
    }

    /**
     * @test
     */
    public function formatWithSingularCountMustBeReturnTheSingularFormatMessage()
    {
        $number = $this->getMock('Meritt\Formatter\Strategies\Number');
        $number->expects($this->any())
          ->method('format')
          ->will($this->returnValue('1'));

        $object = new Pluralize('test', '1 aluno', 'test', $number);

        $this->assertEquals('1 aluno', $object->format(1));
    }

    /**
     * @test
     */
    public function formatWithZeroCountMustBeReturnTheZeroFormatMessage()
    {
        $number = $this->getMock('Meritt\Formatter\Strategies\Number');
        $number->expects($this->any())
          ->method('format')
          ->will($this->returnValue('0'));

        $object = new Pluralize('nenhum aluno', 'test', 'test', $number);

        $this->assertEquals('nenhum aluno', $object->format(0));
    }
}
