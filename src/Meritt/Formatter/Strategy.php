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
 * Base interface for data formatting strategies
 *
 * @author Luís Otávio Cobucci Oblonczyk <luis@meritt.com.br>
 * @author Kaléu Caminha <kaleu@meritt.com.br>
 */
interface Strategy
{
    /**
     * Formats the data using the configured params
     *
     * @param mixed $count
     * @return string
     */
    public function format($count);
}
