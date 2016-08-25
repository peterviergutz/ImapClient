<?php
namespace sgoranov\ImapClient\Sort;

use sgoranov\ImapClient\SortExpression;

class Subject extends SortExpression
{
    public function getKeyword()
    {
        return '\SORTSUBJECT';
    }
}