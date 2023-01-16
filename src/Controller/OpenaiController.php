<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpenaiController extends AbstractController
{
    /**
     * @Route("/openai", name="app_openai")
     */
    public function otherFunction($data,$url): Response
    {
       $apiKey = "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";
       $prompt = 'What is the capital of France';
       $url = $url;
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
           CURLOPT_POSTFIELDS => json_encode(
               $data
           ),
           CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               "Authorization: Bearer $apiKey"
           ),
       ));
       $response = curl_exec($curl);
       curl_close($curl);
       $response_data = json_decode($response, true);
       print_r($response_data);
    //    $generated_text = $response_data['data'];
    //    return new Response($generated_text);
    }
    
}
