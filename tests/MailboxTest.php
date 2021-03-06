<?php

namespace sgoranov\ImapClient\Tests;

use sgoranov\ImapClient\Mailbox;
use sgoranov\ImapClient\Search\Email\To;
use sgoranov\ImapClient\Search\Text\Body;
use sgoranov\ImapClient\SearchExpression;
use sgoranov\ImapClient\Sort\To as SortTo;

class MailboxTest extends AbstractTest
{
    /**
     * @var Mailbox
     */
    protected $mailbox;

    public function setUp()
    {
        $this->mailbox = $this->createMailbox('test-mailbox');

        $this->createTestMessage($this->mailbox, 'Message 1');
        $this->createTestMessage($this->mailbox, 'Message 2');
        $this->createTestMessage($this->mailbox, 'Message 3');
    }

    public function tearDown()
    {
        $this->deleteMailbox($this->mailbox);
    }

    public function testGetName()
    {
        $this->assertStringStartsWith('test-mailbox', $this->mailbox->getName());
    }

    public function testGetMessages()
    {
        $i = 0;
        foreach ($this->mailbox->getMessages() as $message) {
            $i++;
        }

        $this->assertEquals(3, $i);
    }

    /**
     * @expectedException \sgoranov\ImapClient\Exception\MessageDoesNotExistException
     * @expectedExceptionMessageRegExp /Message 666 does not exist.*Bad message number/
     */
    public function testGetMessageThrowsException()
    {
        $this->mailbox->getMessage(666);
    }

    public function testCount()
    {
        $this->assertEquals(3, $this->mailbox->count());
    }

    public function testSearch()
    {
        $this->createTestMessage($this->mailbox, 'Result', 'Contents');
        
        $search = new SearchExpression();
        $search->addCondition(new To('me@here.com'))
            ->addCondition(new Body('Contents'))
        ;
        
        $messages = $this->mailbox->getMessages($search);
        $this->assertCount(1, $messages);
        $this->assertEquals('Result', $messages->current()->getSubject());
    }
    
    public function testSearchNoResults()
    {
        $search = new SearchExpression();
        $search->addCondition(new To('nope@nope.com'));
        $this->assertCount(0, $this->mailbox->getMessages($search));
    }

    public function testSortByTo()
    {
        $this->createTestMessage(
            $this->mailbox,
            'Correct Subject',
            'Content',
            'from-someone-' . rand(1000, 9999) . '@test.com',
            'a-to@test.com');

        $this->createTestMessage(
            $this->mailbox,
            'Incorrect subject',
            'Content',
            'from-someone-' . rand(1000, 9999) . '@test.com',
            'b-to@test.com');

        $messages = $this->mailbox->getMessages(null, new SortTo());
        $this->assertEquals('Correct Subject', $messages->current()->getSubject());
    }

    public function testUtf8Support()
    {
        $expectedValue = 'Тест на кирилица ' . rand(1000, 9999);
        $mailbox = $this->getConnection()->createMailbox($expectedValue);
        $this->assertStringStartsWith('Тест на кирилица', $mailbox->getName());
        $this->getConnection()->deleteMailbox($mailbox);
    }
}
