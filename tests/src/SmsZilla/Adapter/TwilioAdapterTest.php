<?php
namespace SmsZilla\Adapter;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-04-08 at 21:33:49.
 */
class TwilioAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TwilioAdapter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->config = include  __DIR__ . '/../../config.php';
        $this->object = new TwilioAdapter;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers SmsZilla\Adapter\TwilioAdapter::send
     * @todo   Implement testSend().
     */
    public function testSend()
    {
        $message = new \SmsZilla\SmsMessageModel();
        $message->setText($this->config['message']);
        $message->addRecipient($this->config['my_phone']);
        $message->addRecipient($this->config['wrong_phone']);
        $this->object->setParams([
            'api_key' => $this->config['twilio_api_key'],
//            'api_secret' => $this->config['twilio_api_secret'],
            'account_sid' => $this->config['twilio_account_sid'],
            'number' => $this->config['twilio_number']
        ]);
        $result = $this->object->send($message);
        $this->assertTrue($result);
        $this->assertCount(0, $this->object->getErrors());
    }
}
