<?php
namespace sgoranov\ImapClient\Sort;

use sgoranov\ImapClient\SortExpression;

class Size extends SortExpression
{
    public function getKeyword()
    {
        return '\SORTSIZE';
    }
}