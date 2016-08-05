<?php
namespace SmsZilla\Adapter;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-02 at 09:55:14.
 */
class MockAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MockAdapter
     */
    protected $object;
    
    protected $message = null;
    
    private $config = [];

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->config = include  __DIR__ . '/config.php';
        $this->object = new MockAdapter;
        $this->message = new \SmsZilla\MessageModel();
        $this->message->setText($this->config['message']);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers SmsZilla\Adapter\MockGateway::send
     */
    public function testSend()
    {
        $this->object->send($this->message);
        $this->object->send($this->message);
        $this->assertCount(2, $this->object->getSentMessages());
        $this->assertCount(0, $this->object->getErrors());
    }

    /**
     * @covers SmsZilla\Adapter\MockGateway::getSentMessages
     */
    public function testGetSentMessages()
    {
        $this->object->send($this->message);
        $data = $this->object->getSentMessages();
        $this->assertEquals($this->config['message'], $data[0]->getText());
    }
}
