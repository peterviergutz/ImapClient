<?php
namespace sgoranov\ImapClient\Sort;

use sgoranov\ImapClient\SortExpression;

class Arrival extends SortExpression
{
    public function getKeyword()
    {
        return '\SORTARRIVAL';
    }
}