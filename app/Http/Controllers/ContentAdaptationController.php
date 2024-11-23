<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Gemini\Laravel\Facades\Gemini; 

class ContentAdaptationController extends Controller
{
    public function adaptContent(Request $request)
    {
        try {
            
            $messages = [
                'instagram' => $request->input('instagramMessage'),
                'twitter' => $request->input('twitterMessage'),
                'linkedin' => $request->input('linkedinMessage'),
                'medium' => $request->input('mediumMessage'),
            ];

           
            $adaptedContent = $this->adaptContentThroughGemini($messages);

            
            return response()->json($adaptedContent);

        } catch (\Exception $e) {
            
            Log::error('Content adaptation failed: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            
            return response()->json(['error' => 'An error occurred during content adaptation.'], 500);
        }
    }

    // Function to adapt content using Gemini (or another AI service)
    private function adaptContentThroughGemini($messages)
    {
        $adaptedContent = [];

        // Loop through each platform's message and send it for adaptation
        foreach ($messages as $platform => $message) {
            try {
                // Use Gemini::geminiPro() to generate adapted content for each platform
                $result = Gemini::geminiPro()->generateContent("Adapt the following message for $platform: $message");

          
                $botResponse = $result->text();

               
                Log::info("Adapted Content for $platform: " . $botResponse);

               
                $adaptedContent[$platform] = $botResponse;
            } catch (\Exception $e) {
                
                Log::error("Error adapting content for $platform: " . $e->getMessage());
                Log::error("Trace: " . $e->getTraceAsString());

              
                $adaptedContent[$platform] = "Error adapting content for $platform: " . $e->getMessage();
            }
        }

        return $adaptedContent;
    }
}
