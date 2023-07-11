<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use OpenAI;

class PresentationController extends Controller
{
    public function store(Request $request)
    {
        $client = OpenAI::client(env('OPEN_API_KEY'));
        $description = $request->description;
        $prompt = "Generate content for slides presentation on topic {$description}. Use your knowledge to fill the slides with information. Do not output anything else except the content of the slides. Make at least 10 slides";
        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ]
        ]);

        $out = $result['choices'][0]['message']['content'];

        Presentation::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $out,
            'user_id' => auth()->user()->id
        ]);
    }
}
