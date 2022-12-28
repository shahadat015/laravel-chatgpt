<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI;

class ArticleGenerator extends Controller
{
    public function index(Request $input)
    {
        if ($input->title == null) {
            return;
        }

        $title = $input->title;

        $client = OpenAI::client(config('openai.api_key'));

        $result = $client->completions()->create([
            "model"             => "text-davinci-003",
            "temperature"       => 0.7,
            "top_p"             => 1,
            "frequency_penalty" => 0,
            "presence_penalty"  => 0,
            'max_tokens'        => 600,
            'prompt'            => sprintf('Write article about: %s', $title),
        ]);

        $content = trim($result['choices'][0]['text']);

        return response(['title' => $title, 'content' => $content]);
    }
}