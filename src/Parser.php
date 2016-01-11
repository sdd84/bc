<?php
declare(strict_types = 1);

namespace Bc;


class Parser
{
    /**
     * @var Lexer
     */
    private $lexer = null;

    /**
     * @var array
     */
    private $stack = [];

    /**
     * @var array
     */
    private $currentSymbol;

    /**
     * @var int
     */
    private $currentPosition = 0;

    public function __construct(string $input) {
        $this->lexer = new Lexer($input);
    }

    public function parse(string $input) {

    }

    private function expr() {

    }

}