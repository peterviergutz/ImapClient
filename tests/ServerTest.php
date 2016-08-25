<?php

namespace sgoranov\ImapClient\Tests;

use sgoranov\ImapClient\Server;

class ServerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \sgoranov\ImapClient\Exception\AuthenticationFailedException
     */
    public function testFailedAuthenticate()
    {
        $server = new Server('imap.gmail.com');
        $server->authenticate('fake_username', 'fake_password');
    }
}
