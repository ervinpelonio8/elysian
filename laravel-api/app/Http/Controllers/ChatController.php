<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Probots\Pinecone\Client as Pinecone;

class ChatController extends Controller
{
    private $pineconeApiKey;
    private $pineconeIndexName;
    private $googleApiKey;
    private $pinecone;

    public function __construct()
    {
        $this->pineconeApiKey = env('PINECONE_API_KEY');
        $this->pineconeIndexHost = env('PINECONE_INDEX_HOST');
        $this->googleApiKey = env('GOOGLE_API_KEY');

        // Initialize Pinecone client
        $this->pinecone = new Pinecone($this->pineconeApiKey);
    }

    public function chat(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'Query string is required'], 400);
        }

        $embedding = $this->generateEmbedding($query);

        if (!$embedding) {
            return response()->json(['error' => 'Failed to generate embedding'], 500);
        }

        $products = $this->searchPinecone($embedding);
        $ai_recommendation = $this->consultAI($query, $products);

        return response()->json($ai_recommendation);
    }

    private function generateEmbedding($query)
    {
        $client = new Client();
        try {
            $response = $client->post('https://generativelanguage.googleapis.com/v1beta/models/text-embedding-004:embedContent?key=' . $this->googleApiKey, [
                'json' => [
                    'model' => 'models/text-embedding-004',
                    'content' => [
                        'parts' => [
                            ['text' => $query]
                        ]
                    ],
                    'task_type' => 'retrieval_query',
                ]
            ]);

            $body = $response->getBody();
            $data = json_decode($body, true);

            return $data['embedding'] ?? null;

        } catch (\Exception $e) {
            print_r($e->getMessage());
            return null;
        }
    }

    private function consultAI($query, $context)
    {
        $client = new Client();
        $prompt = "You are a helpful assistant of a clothing store. You will recommend to users clothes based on their query and available products. This is the user's query: " . $query . ". These are the available products:  " . json_encode($context) . ". Output in json format like so {message: <Your message to the user>, products: <Array of your recommended products in the following format: {id, name, image, price}>}";

        try {
            $response = $client->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $this->googleApiKey, [
                'json' => [
                    'contents' => [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ],
                ]
            ]);

            $body = $response->getBody();
            $data = json_decode($body, true);

            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return $data['candidates'][0]['content']['parts'][0]['text'];
            } else {
                return null;
            }

        } catch (\Exception $e) {
            print_r($e->getMessage());
            return null;
        }
    }

    private function searchPinecone($queryEmbedding)
    {
        try {
            $this->pinecone->setIndexHost($this->pineconeIndexHost);
            $response = $this->pinecone->data()->vectors()->query(
                vector: $queryEmbedding['values'],
                topK: 20,
                includeMetadata: true
            );
            $body = json_decode($response->body(), true);
            return array_map(function ($match) {
                if (!isset($match['metadata']['json'])) {
                    return null;
                }

                $decoded = json_decode($match['metadata']['json'], true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    return null;
                }
                return $decoded;
            }, $body['matches'] ?? []);


        } catch (\Exception $e) {
            print_r('This is the error: ');
            print_r($e->getMessage());
            return [];
        }
    }
}
