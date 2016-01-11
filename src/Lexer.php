<?php
declare(strict_types = 1);

namespace Bc;


class Lexer
{
    /**
     * @var array string
     */
    private $input = [];

    /**
     * @var int
     */
    private $position = 0;

    public function __construct(string $input)
    {
        $this->input = str_split($input, 1);
    }

    private function peek($callback): bool
    {
        if ($this->position + 1 >= count($this->input)) {
            return false;
        } else {
            $next = ord($this->input[$this->position + 1]);

            return $callback($next);
        }
    }

    public function next()
    {
        $buffer = '';

        for ($this->position = 0; $this->position < count($this->input); $this->position++) {
            $char = $this->input[$this->position];
            $code = ord($char);

            if ($code <= 0x20) { // whitespace & control characters
                continue;
            } elseif ($code >= 0x30 && $code <= 0x39) { // digits
                $buffer .= $char;
                $next = $this->peek(function ($ord) {
                    return $ord >= 0x30 && $ord <= 0x39;
                });
                if ($next) { // digit continued
                    continue;
                } else {
                    yield ['symbol' => Symbol::INTEGER(), 'value' => (int)$buffer];
                    $buffer = '';
                }
            } elseif ($code === 0x2a || $code === 0x2b || $code === 0x2d || $code === 0x2f) { // operators + - * /
                yield ['symbol' => Symbol::OPERATOR(), 'value' => $char];
            } elseif ($code === 0x28) {
                yield ['symbol' => Symbol::LPAREN(), 'value' => $char];
            } elseif ($code === 0x29) {
                yield ['symbol' => Symbol::RPAREN(), 'value' => $char];
            } else {
                throw new SyntaxException("Syntax error on position {$this->position}: unexpected token '$char'!");
            }
        }
    }
}