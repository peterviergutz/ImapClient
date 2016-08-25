<?php
namespace sgoranov\ImapClient\Sort;

use sgoranov\ImapClient\SortExpression;

class Cc extends SortExpression
{
    public function getKeyword()
    {
        return '\SORTCC';
    }
}