<?php
/**
 * This file is part of the Formatter project.
 *
 * @link https://github.com/Meritts/formatter
 * @copyright Copyright (c) 2013 Meritt Informação Educacional (http://www.meritt.com.br)
 * @license Proprietary
 */

namespace Meritt\Formatter;

use ReflectionClass;
use ReflectionException;

/**
 * Format strategy builder
 *
 * @author Luís Otávio Cobucci Oblonczyk <luis@meritt.com.br>
 * @author Kaléu Caminha <kaleu@meritt.com.br>
 */
class Builder
{
    /**
     * Creates a new strategy with the given arguments
     *
     * @param string $strategyName
     * @param array $arguments
     * @return Strategy
     * @throws FormatterException
     */
    public static function __callStatic($strategyName, array $arguments)
    {
        try {
            return static::createStrategy(
                static::getStrategyClass($strategyName),
                $arguments
            );
        } catch (ReflectionException $exception) {
            throw new FormatterException(
                $exception->getMessage(),
                null,
                $exception
            );
        }
    }

    /**
     * Returns the full qualified name of the strategy
     *
     * @param string $strategyName
     * @return string
     */
    protected static function getStrategyClass($strategyName)
    {
        return 'Meritt\\Formatter\\Strategies\\' . ucfirst($strategyName);
    }

    /**
     * Returns a new strategy
     *
     * @param string $strategyFqn
     * @param array $arguments
     * @return Strategy
     */
    protected static function createStrategy($strategyFqn, array $arguments)
    {
        $strategyClass = new ReflectionClass($strategyFqn);

        return $strategyClass->newInstanceArgs($arguments);
    }
}
