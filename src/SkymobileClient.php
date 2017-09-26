<?php

namespace Tomdewit\Skymobile;

use Exception;
use GuzzleHttp\Client;
use Tomdewit\Skymobile\Exceptions\CouldNotSendNotification;

class SkymobileClient
{
    protected $client;

    /**
     * SkymobileClient constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the Message.
     * @param SkymobileMessage $message
     * @throws CouldNotSendNotification
     */
    public function send(SkymobileMessage $message)
    {
        try {
            $query = http_build_query([
                'userid' => config('services.skymobile.username'),
                'passw' => config('services.skymobile.password'),
                'sender' => config('services.skymobile.originator'),
                'gsm' => $message->recipients,
                'text' => $message->body,
            ]);

            $this->client->request('GET', "http://www.skymobile.nl/connect?{$query}");
        } catch (Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}
