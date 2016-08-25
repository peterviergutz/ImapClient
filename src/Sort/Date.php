<?php
namespace sgoranov\ImapClient\Sort;

use sgoranov\ImapClient\SortExpression;

class Date extends SortExpression
{
    public function getKeyword()
    {
        return '\SORTDATE';
    }
}