@extends('layouts.layout')
@section('book')
    <div class="scroll-container container-fluid vh-100 p-0">
        <section class="section" style="background-color: #FD8C4F;">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: transparent;">
                    <div class="container-fluid d-flex flex-column align-items-center">
                        <a href="/" class="navbar-brand mb-4">
                            <img class="logo" src="{{ asset('img/logo.png') }}" alt="logo"
                                style="width: 150px; height: auto;">
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav gap-5">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('index') ? 'text-black' : 'text-white' }}"
                                        href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('about') ? 'text-black' : 'text-white' }}"
                                        href="about">About us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('book') ? 'text-black' : 'text-white' }}"
                                        href="book">Book a meeting</a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ms-auto">
                                @auth
                                    <li class="nav-item">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Logout</button>
                                        </form>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Register / Login</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        </section>

        <section class="section" id="formSection">
            <div class="container-fluid bookbgimg d-flex align-items-end min-vh-100" style="padding-bottom: 50px;">
                <div class="container">
                    <div class="row justify-content-center mb-0">
                        <div class="col-lg-8 col-md-10 bg-white rounded-3 shadow p-4" style="margin-top: auto;">
                            <h3 class="text-center mb-4">Check Booking</h3>
                            @auth
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <form action="{{ route('book.store') }}#formSection" method="post" class="needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="What's your name"
                                                name="name" value="{{ old('name') }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="name@gmail.com"
                                                name="email" value="{{ old('email') }}" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" name="book" id="BookDate"
                                                value="{{ old('book') }}" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Time</label>
                                            <input type="time" class="form-control" name="time" id="TimeBook"
                                                value="{{ old('time') }}" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Business Profile URL</label>
                                            <input type="url" class="form-control" placeholder="www.company.com"
                                                name="url" value="{{ old('url') }}">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Required Service</label>
                                            <select class="form-select" name="drop" required>
                                                <option value="" selected disabled>Choose...</option>
                                                <option value="Social Media Management"
                                                    {{ old('drop') == 'Social Media Management' ? 'selected' : '' }}>
                                                    Social Media Management
                                                </option>
                                                <option value="Social Media Advertisement"
                                                    {{ old('drop') == 'Social Media Advertisement' ? 'selected' : '' }}>
                                                    Social Media Advertisement
                                                </option>
                                                <option value="Other" {{ old('drop') == 'Other' ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Additional Information</label>
                                            <textarea class="form-control" name="detail" rows="3"
                                                placeholder="Please share anything that will help prepare for our meeting">{{ old('detail') }}</textarea>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-lg px-5" name="bookbtn">
                                                Schedule Event
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-warning text-center">
                                    <h4>Please sign in to book a meeting</h4>
                                    <div class="mt-3">
                                        <a href="{{ route('login') }}" class="btn btn-primary me-2">
                                             Login
                                        </a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="btn btn-success">
                                                Register
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date();
            const bookDateInput = document.getElementById("BookDate");
            const bookTimeInput = document.getElementById("TimeBook");

            if (bookDateInput) {
                bookDateInput.min = today.toISOString().split("T")[0];

                bookDateInput.addEventListener("change", function() {
                    const selectedDate = new Date(this.value);
                    const now = new Date();

                    if (selectedDate.toDateString() === now.toDateString()) {
                        const currentTime = now.getHours().toString().padStart(2, '0') + ":" +
                            now.getMinutes().toString().padStart(2, '0');
                        bookTimeInput.min = currentTime;
                    } else {
                        bookTimeInput.removeAttribute("min");
                    }
                });
            }
        });
    </script>
@endsection
