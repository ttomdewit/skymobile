<?php

namespace Tomdewit\Skymobile\Test;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Mockery;
use Tomdewit\Skymobile\SkymobileChannel;
use Tomdewit\Skymobile\SkymobileClient;
use Tomdewit\Skymobile\SkymobileMessage;
use PHPUnit_Framework_TestCase;

class SkymobileChannelTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->notification = new TestNotification;
        $this->string_notification = new TestStringNotification;
        $this->notifiable = new TestNotifiable;
        $this->guzzle = Mockery::mock(new Client());
        $this->client = Mockery::mock(new SkymobileClient($this->guzzle, 'test_ek1qBbKbHoA20gZHM40RBjxzX'));
        $this->channel = new SkymobileChannel($this->client);
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
        $this->assertInstanceOf(SkymobileChannel::class, $this->channel);
    }

    /** @test */
    public function test_it_shares_message()
    {
        $this->client->shouldReceive('send')->once();
        $this->channel->send($this->notifiable, $this->notification);
    }

    /** @test */
    public function if_string_message_can_be_send()
    {
        $this->client->shouldReceive('send')->once();
        $this->channel->send($this->notifiable, $this->string_notification);
    }
}

class TestNotifiable
{
    use Notifiable;

    public function routeNotificationForSkymobile()
    {
        return '0618097867';
    }
}

class TestNotification extends Notification
{
    public function toSkymobile($notifiable)
    {
        return (new SkymobileMessage('Message content'))->setOriginator('APPNAME')->setRecipients('0618097867');
    }
}

class TestStringNotification extends Notification
{
    public function toSkymobile($notifiable)
    {
        return 'Test by string';
    }
}
