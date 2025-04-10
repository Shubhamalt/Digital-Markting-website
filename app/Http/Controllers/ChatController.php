<?php

namespace App\Http\Controllers;
use League\Csv\Reader;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show()
    {
        return view('chat');
    }

    public function handle(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        
        $userMessage = $request->message;
        $response = $this->getBotResponse($userMessage);

        return response()->json(['response' => $response]);
    }

    private function getBotResponse($message)
    {
        $csv = Reader::createFromPath(storage_path('app/digital_marketing_qna.csv'), 'r');
        $csv->setHeaderOffset(0);
        
        $bestMatch = ['similarity' => 0, 'answer' => "I'm not sure about that. Can you ask something else?"];
        $message = strtolower(trim($message));

        foreach ($csv as $row) {
            $similarity = similar_text($message, strtolower(trim($row['question'])), $percent);
            
            if ($percent > $bestMatch['similarity']) {
                $bestMatch = ['similarity' => $percent, 'answer' => $row['answer']];
            }
        }

        return $bestMatch['similarity'] >= 60 ? $bestMatch['answer'] : $bestMatch['answer'];
    }
}
