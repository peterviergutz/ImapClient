<?php

namespace sgoranov\ImapClient\Search\Flag;

use sgoranov\ImapClient\Search\AbstractCondition;

/**
 * Represents a UNFLAGGED flag condition. Messages must no have the \\FLAGGED
 * flag (i.e. urgent or important) set in order to match the condition.
 */
class Unflagged extends AbstractCondition
{
    /**
     * Returns the keyword that the condition represents.
     *
     * @return string
     */
    public function getKeyword()
    {
        return 'UNFLAGGED';
    }
}
