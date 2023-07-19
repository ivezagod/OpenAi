<?php

namespace App\Jobs;

use App\Http\Controllers\PresentationController;
use http\Env\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use OpenAI;

class SendPrompt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $presentation;

    public function __construct($presentation, )
    {
        $this->presentation = $presentation;
    }

    /**
     * Execute the job.
     */
    public function handle( ): void
    {
        $client = OpenAI::client(env('OPEN_API_KEY'));
        $description = $this->presentation->description;
        $prompt = "Generate me a text for markdown reveal.js presentation with all the styling in it and without pictures on topic:{{$description}}. Make 10 slides. Put --- as separator between slides.";
        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ]
        ]);

        $out = $result['choices'][0]['message']['content'];

        $this->presentation->update([
            'content'=>$out
        ]);

    }
}
