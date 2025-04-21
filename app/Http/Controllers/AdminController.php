<?php

namespace App\Http\Controllers;

use App\Models\ChatLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->only(['chatLogs']);
    }

    public function chatLogs()
    {
        $logs = ChatLog::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.chat-logs', [
            'logs' => $logs
        ]);
    }
}
