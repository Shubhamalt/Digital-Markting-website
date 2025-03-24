<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Mail\MeetingStatusMail;
use Illuminate\Support\Facades\Mail;

class MeetingController extends Controller
{
    public function update(Request $request, $id)
{
    $statusMap = [
        'accepted' => 'confirmed',
        'declined' => 'cancelled',
    ];

    $request->validate([
        'status' => 'required|in:pending,accepted,declined',
    ]);

    $meeting = Meeting::findOrFail($id);

    $meeting->status = $statusMap[$request->status] ?? $request->status;  
    $meeting->save();

    Mail::to($meeting->email)->send(new MeetingStatusMail($meeting));

    return redirect()->back()->with('success', 'Meeting status updated and email sent!');
}

    
}
