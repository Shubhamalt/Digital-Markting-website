@extends('layouts.layout')
@section('verifyEmail')
<div style="background-color: #BC67">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center">
            <h1 class="mb-4">Please verify your email through email we sent.</h1>
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button class="btn">Send again</button>
            </form>
            
        </div>
    </div>
</div>

@endsection