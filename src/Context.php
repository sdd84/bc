<?php
declare(strict_types=1);

namespace Boolean;

use Boolean\Expression\VariableExp;

class Context
{
    private $variables = [];

    public function lookup(VariableExp $var): bool {
        if (array_key_exists($var->getName(), $this->variables))
            return $this->variables[$var->getName()];
        else
            return false;
    }

    public function assign(VariableExp $var, bool $value) {
        $this->variables[$var->getName()] = $value;
    }
}