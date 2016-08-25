<?php
namespace sgoranov\ImapClient\Sort;

use sgoranov\ImapClient\SortExpression;

class To extends SortExpression
{
    public function getKeyword()
    {
        return '\SORTTO';
    }
}