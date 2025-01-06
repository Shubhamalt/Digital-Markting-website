<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request){
        $userMessage = $request -> input('message');
        $botReply = $this->getBotReply($userMessage);

        return response() -> json(['reply' => $botReply]);
    }

    private function getBotReply($message){
        if(strtolower($message) == 'hello'){
            return 'Hello! How are you';
        }
        elseif(strtolower($message) == 'bye'){
            return 'Goodbye!';
        }
        elseif(strtolower($message) == 'what are your fees'){
            return 'Please contact us';
        }
        else{
            return "I'm sorry I don't understand";
        }
    }
}
