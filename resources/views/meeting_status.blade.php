@extends('layouts.layout')
@section('Mailstatus')
    <p>Dear {{ $meeting->name }},</p>

    <p>Your meeting scheduled on {{ $meeting->book }} at {{ $meeting->time }} has been
        <strong>{{ ucfirst($meeting->status) }}</strong>.</p>

    <p>Thank you for choosing Sticmarketing.</p>

    <p>Best Regards,</p>
    <p>Sticmarketing Team</p>
@endsection
