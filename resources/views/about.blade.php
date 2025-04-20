@extends('layouts.layout')
@section('about')
    <div class="scroll-container">
        <section class="section" style="background-color: #FD8C4F;">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                    <div class="container-fluid flex-column">
                        <!-- Logo and Toggler Row -->
                        <div class="d-flex w-100 justify-content-center align-items-center">
                            <a href="/" class="navbar-brand">
                                <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid" style="width: 150px;">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
            
                        <div class="collapse navbar-collapse w-100" id="navbarNav">
                            <ul class="navbar-nav w-100 justify-content-center align-items-lg-center gap-3 gap-lg-5">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-black" href="about">About us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="book">Book a meeting</a>
                                </li>
            
                                @auth
                                    @if(Auth::user()->is_admin)
                                        <li class="nav-item">
                                            <a class="nav-link text-success" href="{{ route('admin') }}">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-success" href="{{ route('admin.chat-logs') }}">Chat Logs</a>
                                        </li>
                                    @endif
                                @endauth
                                
                                <li class="nav-item ms-lg-auto">
                                    @auth
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Register / Login</a>
                                    @endauth
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        </section>

        <section class="section bg-primary">
            <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
                <h1 class="d-flex justify-content-center align-items-center pt-5">Our Team</h1>
                <div class="row text-center">
                    <div class="col-md-6 col-6 position-relative mt-5">
                        <img src="{{ asset('img/sirish.jpg') }}" alt="photosirish" class="img-fluid aboutimg"
                            style="height:60vh; width: auto;">
                    </div>
                    <div class="col-md-6 col-6 position-relative mt-5">
                        <img src="{{ asset('img/subash.jpg') }}" alt="photosubash" class="img-fluid aboutimg"
                            style="height: 60vh; width: auto;">
                    </div>
                </div>
            </div>
        </section>

        <div class="section bg-success">
            <div class="container gap123">
                <div class="row">
                    <h1 class="mar col-12 col-md-12 d-flex align-items-center justify-content-center display-3">Why choose
                        us?</h1>
                    <p class="mt-2 col-12 col-md-12 d-flex align-items-center justify-content-center display-3">We've worked
                        with</p>
                </div>
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('img/mcdodo.png') }}" alt="mcdodo" class="img-fluid h-75"
                            style="height: 25vh; width: auto;">
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/outreach.png') }}" alt="outreach" class="img-fluid h-75"
                            style="height: 25vh; width: auto;">
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/svetah.jpg') }}" alt="svetah" class="img-fluid h-75"
                            style="height: 25vh; width: auto;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('img/commbank.jpg') }}" alt="commbank" class="img-fluid h-75"
                            style="height: 25vh; width: auto;">
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('img/lacap-640w.png') }}" alt="lacap" class="img-fluid h-75"
                            style="height: 25vh; width: auto;">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
