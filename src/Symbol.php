<?php

namespace Bc;


use MyCLabs\Enum\Enum;

class Symbol extends Enum
{
    const INTEGER = 1;
    const FLOAT = 2;
    const OPERATOR = 3;
    const LPAREN = 7;
    const RPAREN = 8;
}