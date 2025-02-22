<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenAIService
{
    protected Client $client;
    protected mixed $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENAI_API_KEY');
    }

    /**
     * @throws GuzzleException
     */
    public function chat($message)
    {
        $systemPrompt = "Ты - помощник по программам DAAD. Используй информацию в сайте DAAD о программах";

        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => "Bearer $this->apiKey",
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [

                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $message],
                ],
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);
        return json_decode($responseData['choices'][0]['message']['content'], true);
    }
}
