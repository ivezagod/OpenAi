<?php

namespace App\Http\Controllers;

use App\Jobs\AddPresentationToDatabase;
use App\Jobs\SendPrompt;
use App\Models\Presentation;
use Illuminate\Http\Request;
use OpenAI;

class PresentationController extends Controller
{

    public function store(Request $request)
    {

       $presentation =  Presentation::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => '',
            'user_id' => auth()->user()->id
        ]);

        SendPrompt::dispatch($presentation);

        return redirect()->route('dashboard');

    }

    public function show($id)
    {
        return view('presentation',[
           'presentation'  => Presentation::find($id)
        ]);
    }
}
