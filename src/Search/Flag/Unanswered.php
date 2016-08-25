<?php

namespace sgoranov\ImapClient\Search\Flag;

use sgoranov\ImapClient\Search\AbstractCondition;

/**
 * Represents an UNANSWERED flag condition. Messages must not have the
 * \\ANSWERED flag set in order to match the condition.
 */
class Unanswered extends AbstractCondition
{
    /**
     * Returns the keyword that the condition represents.
     *
     * @return string
     */
    public function getKeyword()
    {
        return 'UNANSWERED';
    }
}
