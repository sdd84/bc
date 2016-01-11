<?php
declare(strict_types=1);

namespace Boolean;

use Boolean\Expression\BooleanExp;

class Interpreter
{

    public function evaluate(BooleanExp $expression, Context $context): bool
    {
        return $expression->evaluate($context);
    }
}