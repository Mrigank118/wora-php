<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Gemini\Laravel\Facades\Gemini; // Import the Gemini facade

class ContentAdaptationController extends Controller
{
    public function adaptContent(Request $request)
    {
        try {
            // Get the messages for each platform
            $messages = [
                'instagram' => $request->input('instagramMessage'),
                'twitter' => $request->input('twitterMessage'),
                'linkedin' => $request->input('linkedinMessage'),
                'medium' => $request->input('mediumMessage'),
            ];

            // Send the messages to Gemini (or your AI service) for content adaptation
            $adaptedContent = $this->adaptContentThroughGemini($messages);

            // Return the adapted content as a JSON response
            return response()->json($adaptedContent);

        } catch (\Exception $e) {
            // Log the error message
            Log::error('Content adaptation failed: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            // Return a JSON error response
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

                // Get the response content (assumes `text()` returns the adapted content)
                $botResponse = $result->text();

                // Log the result for debugging
                Log::info("Adapted Content for $platform: " . $botResponse);

                // Store the adapted content in the result array
                $adaptedContent[$platform] = $botResponse;
            } catch (\Exception $e) {
                // Log any errors during adaptation
                Log::error("Error adapting content for $platform: " . $e->getMessage());
                Log::error("Trace: " . $e->getTraceAsString());

                // Store error message if adaptation fails
                $adaptedContent[$platform] = "Error adapting content for $platform: " . $e->getMessage();
            }
        }

        return $adaptedContent;
    }
}
