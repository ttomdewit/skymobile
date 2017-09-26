<?php

namespace Tomdewit\Skymobile;

use Illuminate\Notifications\Notification;

class SkymobileChannel
{
    /** @var \Tomdewit\Skymobile\SkymobileClient */
    protected $client;

    public function __construct(SkymobileClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \Tomdewit\Skymobile\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSkymobile($notifiable);

        if (is_string($message)) {
            $message = SkymobileMessage::create($message);
        }

        if ($to = $notifiable->routeNotificationFor('skymobile')) {
            $message->setRecipients($to);
        }

        $this->client->send($message);
    }
}
