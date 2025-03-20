@extends('layouts.layout')
@section('book')
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: transparent;">
            <div class="container-fluid d-flex flex-column align-items-center">
                <a href="/" class="navbar-brand mb-4">
                    <img class="logo" src="{{ asset('img/logo.png') }}" alt="logo" style="width: 150px; height: auto;">
                </a>
        
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav gap-5">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('index') ? 'text-black' : 'text-white' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('about') ? 'text-black' : 'text-white' }}" href="about">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('book') ? 'text-black' : 'text-white' }}" href="book">Book a meeting</a>
                        </li>
                    </ul>
        
                    <!-- Conditional Auth Buttons -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <!-- Show logout button if the user is logged in -->
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </li>
                        @else
                            <!-- Show Register/Login button if the user is not logged in -->
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-primary">Register / Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="container-fluid bookbgimg p-0">
        <div class="container bookbox">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 bg-white borderbox shadow p-4 mb-3">
                    <h3 class="d-flex justify-content-center pb-2">
                        Check booking
                    </h3>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('book.store') }}" method="post">
                        @csrf
                        <div class="row d-flex align-items-end justify-content-center gap-5">
                            <div class="col-lg-3 col-3">
                                <p>Name</p>
                                <input type="text" class="form-control" placeholder="What's your name" name="name"
                                    required>
                            </div>
                            <div class="col-lg-3 col-3">
                                <p>Book</p>
                                <input type="date" class="form-control" name="book" id="BookDate" required>
                            </div>
                            <div class="col-lg-3 col-3">
                                <p>Time</p>
                                <input type="time" class="form-control" name="time" id="TimeBook" required>
                            </div>
                            <div class="col-lg-3 col-3">
                                <p>Email</p>
                                <input type="email" class="form-control" placeholder="name@gmail.com" name="email"
                                    required>
                            </div>
                            <div class="col-lg-3 col-3">
                                <p>Your business profile link</p>
                                <input type="url" class="form-control" placeholder="www.company.com" name="url">
                            </div>
                            <div class=" w-25 col-lg-3 col-3">
                                <p>Required Service?</p>
                                <select class="form-select" id="inputGroupSelect02" name="drop">
                                    <option selected>Choose...</option>
                                    <option value="Social Media Management">Social Media Management</option>
                                    <option value="Social Media Advertisement">Social Media Advertisement</option>
                                    <option value="3">Other</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 col-10">
                                    <p>Please share anything that will help prepare for our meeting</p>
                                    <input type="text" class="w-100" name="detail">
                                </div>
                                <div class="col-lg-2 col-2">
                                    <input type="submit" name="bookbtn" value="Schedule Event">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    let today = new Date();
    let todayDate = today.toISOString().split("T")[0]; // Get today's date (YYYY-MM-DD)
    let bookDateInput = document.getElementById("BookDate"); // Fix ID
    let bookTimeInput = document.getElementById("TimeBook"); // Fix ID

    // Set minimum selectable date to today
    bookDateInput.setAttribute("min", todayDate);

    bookDateInput.addEventListener("change", function () {
        let selectedDate = new Date(this.value);
        let now = new Date();
        
        if (selectedDate.toDateString() === now.toDateString()) {
            // If today is selected, limit time to current time or later
            let currentTime = now.getHours().toString().padStart(2, '0') + ":" + 
                              now.getMinutes().toString().padStart(2, '0');
            bookTimeInput.setAttribute("min", currentTime);
        } else {
            // Remove time restriction if another date is selected
            bookTimeInput.removeAttribute("min");
        }
    });
});
    </script>
@endsection
