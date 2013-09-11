<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kaleu
 * Date: 11/09/13
 * Time: 16:01
 * To change this template use File | Settings | File Templates.
 */

namespace Meritt\Formatter\Strategies;

use Meritt\Formatter\Strategy;

class Number implements Strategy
{
    public function format($data)
    {
        return $data;
    }
}
