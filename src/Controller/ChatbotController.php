<?php

namespace App\Controller;
use OpenAI\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatbotController extends AbstractController
{
    /**
     * @Route("/chatbot", name="app_chatbot")
     */
    public function index(): Response
    {

        $apiKey = "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";
        $prompt = 'What is the capital of odisha';
        $url = 'https://api.openai.com/v1/engines/text-davinci-002/completions';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'prompt' => $prompt,
            ]),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $apiKey"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response_data = json_decode($response, true);
        $generated_text = $response_data['choices'][0]['text'];
        return new Response($generated_text);
    }
}
