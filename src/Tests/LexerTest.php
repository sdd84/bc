<?php

namespace Bc\Tests;


use Bc\Lexer;
use Bc\Symbol;

class LexerTest extends \PHPUnit_Framework_TestCase
{
    public function testInt() {
        $input = ' 1234 456  1';
        $lexer = new Lexer($input);
        $tokens = [];

        foreach ($lexer->next() as $token)
            $tokens[] = $token;

        $this->assertEquals(Symbol::INTEGER(), $tokens[0]['symbol']);
        $this->assertEquals(1234, $tokens[0]['value']);
        $this->assertEquals(Symbol::INTEGER(), $tokens[1]['symbol']);
        $this->assertEquals(456, $tokens[1]['value']);
        $this->assertEquals(Symbol::INTEGER(), $tokens[2]['symbol']);
        $this->assertEquals(1, $tokens[2]['value']);
    }

    public function testOperators() {
        $input = ' 1234 + 456 -1 * 4711 / 7';
        $lexer = new Lexer($input);
        $tokens = [];

        foreach ($lexer->next() as $token)
            $tokens[] = $token;

        $this->assertEquals(Symbol::INTEGER(), $tokens[0]['symbol']);
        $this->assertEquals(1234, $tokens[0]['value']);
        $this->assertEquals(Symbol::OPERATOR(), $tokens[1]['symbol']);
        $this->assertEquals('+', $tokens[1]['value']);
        $this->assertEquals(Symbol::INTEGER(), $tokens[2]['symbol']);
        $this->assertEquals(456, $tokens[2]['value']);
        $this->assertEquals(Symbol::OPERATOR(), $tokens[3]['symbol']);
        $this->assertEquals('-', $tokens[3]['value']);
        $this->assertEquals(Symbol::INTEGER(), $tokens[4]['symbol']);
        $this->assertEquals(1, $tokens[4]['value']);
        $this->assertEquals(Symbol::OPERATOR(), $tokens[5]['symbol']);
        $this->assertEquals('*', $tokens[5]['value']);
        $this->assertEquals(Symbol::INTEGER(), $tokens[6]['symbol']);
        $this->assertEquals(4711, $tokens[6]['value']);
        $this->assertEquals(Symbol::OPERATOR(), $tokens[7]['symbol']);
        $this->assertEquals('/', $tokens[7]['value']);
        $this->assertEquals(Symbol::INTEGER(), $tokens[8]['symbol']);
        $this->assertEquals(7, $tokens[8]['value']);
    }

    public function testParentheses() {
        $input = ' 1234 * (456 + 2)';
        $lexer = new Lexer($input);
        $tokens = [];

        foreach ($lexer->next() as $token)
            $tokens[] = $token;

        $this->assertEquals(Symbol::INTEGER(), $tokens[0]['symbol']);
        $this->assertEquals(1234, $tokens[0]['value']);
        $this->assertEquals(Symbol::OPERATOR(), $tokens[1]['symbol']);
        $this->assertEquals('*', $tokens[1]['value']);
        $this->assertEquals(Symbol::LPAREN(), $tokens[2]['symbol']);
        $this->assertEquals('(', $tokens[2]['value']);
        $this->assertEquals(Symbol::INTEGER(), $tokens[3]['symbol']);
        $this->assertEquals(456, $tokens[3]['value']);
        $this->assertEquals(Symbol::OPERATOR(), $tokens[4]['symbol']);
        $this->assertEquals('+', $tokens[4]['value']);
        $this->assertEquals(Symbol::INTEGER(), $tokens[5]['symbol']);
        $this->assertEquals(2, $tokens[5]['value']);
        $this->assertEquals(Symbol::RPAREN(), $tokens[6]['symbol']);
        $this->assertEquals(')', $tokens[6]['value']);
    }
}