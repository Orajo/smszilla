<?php
namespace SmsZilla\Adapter;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-05 at 11:36:21.
 */
class CiscoAdapterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CiscoAdapter
     */
    protected $object;
    
    private $config = [];

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->config = include  __DIR__ . '/../../config.php';
        $this->object = new CiscoAdapter;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * ssh login and pass are not set
     *
     * @covers SmsZilla\Adapter\CiscoAdapter::send
     * @covers SmsZilla\Adapter\AbstractAdapter::setParams
     * @covers \SmsZilla\ConfigurationException::__construct
     */
    public function testSendConfigError()
    {
        $this->expectExceptionMessage("SmsZilla\Adapter\CiscoAdapter is not configured properly. If SSH is enabled then parameters \"ssh_host\" and \"ssh_login\" must be set.");
        $this->expectException(\SmsZilla\ConfigurationException::class);
        $this->object->setParams(['use_ssh' => true]);
        // store_path is not set
        $this->object->send(new \SmsZilla\SmsMessageModel);
    }
    
    /**
     * @covers SmsZilla\Adapter\CiscoAdapter::send
     * @covers SmsZilla\Adapter\AbstractAdapter::addError
     */
    public function testSend()
    {
        $message = new \SmsZilla\SmsMessageModel();
        $message->setText($this->config['message']);
        $message->addRecipient($this->config['phones'][0]);
        $result = $this->object->send($message);
        $this->assertTrue($result);
        $this->assertCount(0, $this->object->getErrors());
    }
    
    /**
     * @covers SmsZilla\Adapter\CiscoAdapter::send
     * @covers SmsZilla\SmsMessageModel::setText
     * @covers SmsZilla\SmsMessageModel::addRecipient
     * @covers SmsZilla\Adapter\AbstractAdapter::setParams
     * @covers SmsZilla\Adapter\AbstractAdapter::getErrors
     * @covers SmsZilla\Adapter\AbstractAdapter::addError
     */
    public function testSendSsh()
    {
        $message = new \SmsZilla\SmsMessageModel();
        $message->setText($this->config['message']);
        $message->addRecipient($this->config['phones'][0]);
        
        $this->object->setParams(['use_ssh' => true]);
        $this->object->setParams(['ssh_login' => 'dummy_user']);
        $this->object->setParams(['ssh_host' => '127.0.0.1']);
        
        $result = $this->object->send($message);
        $this->assertTrue($result);
        $this->assertCount(0, $this->object->getErrors());
    }

}
