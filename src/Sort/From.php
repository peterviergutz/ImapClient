<?php
namespace sgoranov\ImapClient\Sort;

use sgoranov\ImapClient\SortExpression;

class From extends SortExpression
{
    public function getKeyword()
    {
        return '\SORTFROM';
    }
}