<?php
/**
 * This file is part of the Formatter project.
 *
 * @link https://github.com/Meritts/formatter
 * @copyright Copyright (c) 2013 Meritt Informação Educacional (http://www.meritt.com.br)
 * @license Proprietary
 */

namespace Meritt\Formatter\Strategies;

/**
 * @author Kaléu Caminha <kaleu@meritt.com.br>
 * @author Luís Otávio Cobucci Oblonczyk <luis@meritt.com.br>
 */
class NumberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function defaultDataShouldBeUsedIfNoArgumentIsPassedOnConstructor()
    {
        $formatter = new Number();

        $this->assertEquals('999.999.999,99', $formatter->format(999999999.993));
    }

    /**
     * @test
     */
    public function formatConfigurationShouldBePassedOnConstructor()
    {
        $formatter = new Number(3, '.', ',');

        $this->assertEquals('999,999,999.993', $formatter->format(999999999.993));
    }

    /**
     * @test
     * @dataProvider invalidPrecisions
     * @expectedException \InvalidArgumentException
     */
    public function precisionMustBeAIntegerGreaterOrEqualsToZero($precision)
    {
        new Number($precision);
    }

    public function invalidPrecisions()
    {
        return [
            [''],
            [-1],
            ['asdfasdf'],
            [null],
            [false],
            [[1]],
            [(object) ['asdasd' => 'asdasd']],
        ];
    }

    /**
     * @test
     * @dataProvider invalidSeparators
     * @expectedException \InvalidArgumentException
     */
    public function decimalSeparatorMustBeANonNumericDigit($decimalSeparator)
    {
        new Number(2, $decimalSeparator);
    }

    /**
     * @test
     * @dataProvider invalidSeparators
     * @expectedException \InvalidArgumentException
     */
    public function thousandsSeparatorMustBeANonNumericDigit($thousandsSeparator)
    {
        new Number(2, ',', $thousandsSeparator);
    }

    public function invalidSeparators()
    {
        return [
            [''],
            ['2'],
            [-1],
            ['asdfasdf'],
            [null],
            [false],
            [[1]],
            [(object) ['asdasd' => 'asdasd']],
        ];
    }
}
