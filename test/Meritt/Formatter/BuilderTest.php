<?php
/**
 * This file is part of the Formatter project.
 *
 * @link https://github.com/Meritts/formatter
 * @copyright Copyright (c) 2013 Meritt Informação Educacional (http://www.meritt.com.br)
 * @license Proprietary
 */

namespace Meritt\Formatter;

/**
 * @author Kaléu Caminha <kaleu@meritt.com.br>
 * @author Luís Otávio Cobucci Oblonczyk <luis@meritt.com.br>
 */
class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Meritt\Formatter\FormatterException
     */
    public function shouldRaiseExceptionWhenCallingAnInvalidStrategy()
    {
        Builder::invalidStrategyForTests();
    }

    /**
     * @test
     */
    public function shouldReturnAValidStrategy()
    {
        $strategy = Builder::number();
        $this->assertInstanceOf('Meritt\Formatter\Strategies\Number', $strategy);
    }
}
