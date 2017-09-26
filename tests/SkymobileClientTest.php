<?php

namespace Tomdewit\Skymobile\Test;

use GuzzleHttp\Client;
use Mockery;
use Tomdewit\Skymobile\SkymobileClient;
use Tomdewit\Skymobile\SkymobileMessage;
use PHPUnit_Framework_TestCase;

class SkymobileClientTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->guzzle = Mockery::mock(new Client());
        $this->client = Mockery::mock(new SkymobileClient($this->guzzle, 'test_ek1qBbKbHoA20gZHM40RBjxzX'));
        $this->message = (new SkymobileMessage('Message content'))->setOriginator('APPNAME')->setRecipients('0618097867');
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(SkymobileClient::class, $this->client);
        $this->assertInstanceOf(SkymobileMessage::class, $this->message);
    }

    /** @test */
    public function it_can_send_message()
    {
        $this->client->send($this->message);
    }
}
