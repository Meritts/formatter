<?php
/**
 * This file is part of the Formatter project.
 *
 * @link https://github.com/Meritts/formatter
 * @copyright Copyright (c) 2013 Meritt Informação Educacional (http://www.meritt.com.br)
 * @license Proprietary
 */

namespace Meritt\Formatter\Strategies;

use InvalidArgumentException;
use Meritt\Formatter\Strategy;
use Respect\Validation\Validator as v;

/**
 * The format strategy for numbers
 *
 * @author Luís Otávio Cobucci Oblonczyk <luis@meritt.com.br>
 * @author Kaléu Caminha <kaleu@meritt.com.br>
 */
class Number implements Strategy
{
    /**
     * Number of decimal places
     *
     * @var int
     */
    protected $precision;

    /**
     * Character to separate decimal places
     *
     * @var string
     */
    protected $decimalSeparator;

    /**
     * Character to separate thousands
     *
     * @var string
     */
    protected $thousandsSeparator;

    /**
     * Class constructor
     *
     * @param int $precision
     * @param string $decimalSeparator
     * @param string $thousandsSeparator
     */
    public function __construct(
        $precision = 2,
        $decimalSeparator = ',',
        $thousandsSeparator = '.'
    ) {
        $this->setPrecision($precision);
        $this->setDecimalSeparator($decimalSeparator);
        $this->setThousandsSeparator($thousandsSeparator);
    }

    /**
     * Configures the number precision
     *
     * @param int $precision
     * @throws InvalidArgumentException
     */
    protected function setPrecision($precision)
    {
        if (!v::int()->min(0, true)->validate($precision)) {
            throw new InvalidArgumentException(
                'The precision should be a int greater than or equal 0'
            );
        }

        $this->precision = $precision;
    }

    /**
     * Configures the decimal separator
     *
     * @param string $decimalSeparator
     * @throws InvalidArgumentException
     */
    protected function setDecimalSeparator($decimalSeparator)
    {
        if (!v::allOf(v::not(v::numeric()), v::string()->length(1, 1))->validate($decimalSeparator)) {
            throw new InvalidArgumentException(
                'The decimal separator is only a one character'
            );
        }

        $this->decimalSeparator = $decimalSeparator;
    }

    /**
     * Configures the thousands separator
     *
     * @param string $thousandsSeparator
     * @throws InvalidArgumentException
     */
    protected function setThousandsSeparator($thousandsSeparator)
    {
        if (!v::allOf(v::not(v::numeric()), v::string()->length(1, 1))->validate($thousandsSeparator)) {
            throw new InvalidArgumentException(
                'The thousands separator is only a one character'
            );
        }

        $this->thousandsSeparator = $thousandsSeparator;
    }

    /**
     * Formats the given number using the strategy configuration
     *
     * @param number $data
     * @return string
     */
    public function format($data)
    {
        return number_format(
            $data,
            $this->precision,
            $this->decimalSeparator,
            $this->thousandsSeparator
        );
    }
}
