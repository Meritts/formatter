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
 * The format strategy for plurals
 *
 * @author Luís Otávio Cobucci Oblonczyk <luis@meritt.com.br>
 * @author Kaléu Caminha <kaleu@meritt.com.br>
 */
class Pluralize implements Strategy
{
    /**
     * Message to used when count is zero
     *
     * @var string
     */
    protected $zeroMessageFormat;

    /**
     * Message to used when count is one
     *
     * @var string
     */
    protected $singularMessageFormat;

    /**
     * Message to used when count is greater then one
     *
     * @var string
     */
    protected $pluralMessageFormat;

    /**
     * The Formatter to count value in message
     *
     * @var Number
     */
    protected $formatter;

    /**
     * Class constructor
     *
     * @param string $zeroMessageFormat
     * @param string $singularMessageFormat
     * @param string $pluralMessageFormat
     * @param Number $formatter
     */
    public function __construct(
        $zeroMessageFormat,
        $singularMessageFormat,
        $pluralMessageFormat,
        Number $formatter = null
    ) {
        $this->validateMessages(
            $zeroMessageFormat,
            $singularMessageFormat,
            $pluralMessageFormat
        );

        $this->zeroMessageFormat = $zeroMessageFormat;
        $this->singularMessageFormat = $singularMessageFormat;
        $this->pluralMessageFormat = $pluralMessageFormat;
        $this->formatter = $formatter;
    }

    /**
     * Validate the messages
     *
     * @param string $zeroMessageFormat     zero message
     * @param string $singularMessageFormat singular message
     * @param string $pluralMessageFormat   plural message
     *
     * @throws \InvalidArgumentException
     */
    protected function validateMessages(
        $zeroMessageFormat,
        $singularMessageFormat,
        $pluralMessageFormat
    ) {
        $validator = v::string()->notEmpty();

        if (!$validator->validate($zeroMessageFormat)) {
            throw new InvalidArgumentException(
                'Zero message must be a non empty string'
            );
        }

        if (!$validator->validate($singularMessageFormat)) {
            throw new InvalidArgumentException(
                'Singular message must be a non empty string'
            );
        }

        if (!$validator->validate($pluralMessageFormat)) {
            throw new InvalidArgumentException(
                'Plural message must be a non empty string'
            );
        }
    }

    /**
     * Formats the data using the configured params
     *
     * @param int $count
     * @return string
     */
    public function format($count)
    {
        return sprintf(
            $this->getFormat($count),
            $this->formatter ? $this->formatter->format($count) : $count
        );
    }

    /**
     * Returns the message format according the count
     *
     * @param int $count
     * @return string
     */
    protected function getFormat($count)
    {
        if ($count === 0) {
            return $this->zeroMessageFormat;
        }

        if ($count === 1) {
            return $this->singularMessageFormat;
        }

        return $this->pluralMessageFormat;
    }
}
