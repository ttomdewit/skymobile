<?php

namespace Tomdewit\Skymobile\Test;

use Tomdewit\Skymobile\SkymobileMessage;

class SkymobileMessageTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $message = new SkymobileMessage;

        $this->assertInstanceOf(SkymobileMessage::class, $message);
    }

    /** @test */
    public function it_can_accept_body_content_when_created()
    {
        $message = new SkymobileMessage('Foo');

        $this->assertEquals('Foo', $message->body);
    }

    /** @test */
    public function it_supports_create_method()
    {
        $message = SkymobileMessage::create('Foo');

        $this->assertInstanceOf(SkymobileMessage::class, $message);
        $this->assertEquals('Foo', $message->body);
    }

    /** @test */
    public function it_can_set_body()
    {
        $message = (new SkymobileMessage)->setBody('Bar');

        $this->assertEquals('Bar', $message->body);
    }

    /** @test */
    public function it_can_set_originator()
    {
        $message = (new SkymobileMessage)->setOriginator('APPNAME');

        $this->assertEquals('APPNAME', $message->originator);
    }

    /** @test */
    public function it_can_set_recipients_from_array()
    {
        $message = (new SkymobileMessage)->setRecipients(['0618097867']);

        $this->assertEquals('0618097867', $message->recipients);
    }

    /** @test */
    public function it_can_set_recipients_from_integer()
    {
        $message = (new SkymobileMessage)->setRecipients(31618097867);

        $this->assertEquals(31618097867, $message->recipients);
    }

    /** @test */
    public function it_can_set_recipients_from_string()
    {
        $message = (new SkymobileMessage)->setRecipients('0618097867');

        $this->assertEquals('0618097867', $message->recipients);
    }
}
