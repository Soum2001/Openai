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
               
                'prompt' => $prompt
               
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
    public function openaiImage()
    {
        $api_key = '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';
        $url = 'https://api.openai.com/v1/images/generations';

        $data = array(
            'model' => 'image-alpha-001',
            'prompt' => 'Please generate an image of a cat',
            'num_images' => 1
        );
        
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $api_key
            ),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data)
        );
        
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);
        $response_data = json_encode($response, true);
        print_r($response_data);
        // return $this->render('image.html.twig', [
        //     'imageData' => $response_data
        // ]);
        // $generated_text = $response_data['choices'][0]['text'];
        // return new Response($generated_text);
    }
    public function passCompletionData()
    {
        $data = [ 
        'prompt' => 'What is the capital of odisha',
        ];
        $url ="https://api.openai.com/v1/engines/text-davinci-002/completions";
        $otherController = new OpenaiController();
        return $otherController->otherFunction($data,$url);
    }
    public function passEmbeddingData()
    {
        $data = [ 
            'model' => 'text-embedding-ada-002',
            'input' => 'The food was delicious and the waiter...',
            "instruction"=> "Fix the spelling mistakes"
        ];
        $url ="https://api.openai.com/v1/embeddings";
        $otherController = new OpenaiController();
        return $otherController->otherFunction($data,$url);
    }
}
