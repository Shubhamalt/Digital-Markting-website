<?php

namespace App\Http\Controllers;

use App\Models\booking;
use DateTime;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string',
            'book' => ['required', 'date', 'after_or_equal:today'],  
            'time' => 'required',
            'email' => 'required|email',
            'url' => 'nullable|url',
            'drop' => 'required|string',
            'detail' => 'nullable|string',
        ]);

        // Ensure users can't pick past times on the current day
        $selectedDateTime = new DateTime($request->book . ' ' . $request->time);
        $currentDateTime = new DateTime();

        if ($selectedDateTime < $currentDateTime) {
            return back()->withErrors(['time' => 'You cannot book a past time.'])->withInput();
        }

        booking::create($request->all());

        return redirect()->back()->with('success', 'Booking confirmed!');
    }

    public function admin(){
        //getting data from saved from the model in the database
        $records = booking::all();

        return view('admin', compact('records'));
    }
}
