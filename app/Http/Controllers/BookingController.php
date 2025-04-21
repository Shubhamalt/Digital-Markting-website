<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request with additional rules
        $validated = $request->validate([
            'name' => 'required|string',
            'book' => [
                'required', 
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->isSaturday()) {
                        $fail('Weekend bookings are not available.');
                    }
                },
            ],
            'time' => [
                'required',
                function ($attribute, $value, $fail) {
                    $hour = (int) explode(':', $value)[0];
                    if ($hour < 8 || $hour >= 18) {
                        $fail('Bookings available between 8 AM and 6 PM only.');
                    }
                },
            ],
            'email' => 'required|email',
            'url' => 'nullable|url',
            'drop' => 'required|string',
            'detail' => 'nullable|string',
        ]);

        // Additional validation for current day times
        $selectedDate = Carbon::parse($request->book);
        $currentTime = Carbon::now();
        
        if ($selectedDate->isToday()) {
            $selectedDateTime = Carbon::parse($request->book . ' ' . $request->time);
            if ($selectedDateTime->lt($currentTime)) {
                return back()->withErrors(['time' => 'You cannot book a past time.'])->withInput();
            }
        }

        Booking::create($request->all());

        return redirect()->back()->with('success', 'Booking confirmed! Check mail for meeting approval.');
    }

    public function admin()
    {
        $records = Booking::all();
        return view('admin', compact('records'));
    }
}