@extends('layouts.layout')
@section('home')
    <div class="scroll-container">
        <section class="section" style="background-color: #FD8C4F;">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                    <div class="container-fluid flex-column">
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
                                    <a class="nav-link text-black" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="about">About us</a>
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
        <section class="section bg-warning">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                        <h1 class="display-4">Double Your Sales Within 90 Days!</h1>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="/img/rb_126654.png" alt="Double sales" class="photoSales img-fluid">
                    </div>
                </div>
            </div>
        </section>

        <section class="section bg-success">
            <div class="container text-center">
                <h1>Our Numbers</h1>
                <div class="row align-items-center">
                    <div class="col-md-4 text-start mb-4 mb-md-0">
                        <h1>31M Views on <br> TikTok</h1>
                    </div>

                    <div class="col-md-4">
                        <img src="{{ asset('img/2.2.png') }}" alt="Basketball" class="img-fluid w-75">
                    </div>

                    <div class="col-md-4 text-end mb-4 mb-md-0">
                        <h1>100K on <br> Ad Spend</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="section bg-primary">
            <div class="container text-center">
                <h1>Our Services</h1>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Social Media Marketing</h2>
                        <ul>
                            <li>UGC Content</li>
                            <li>Social Media Post</li>
                            <li>Content Creation</li>
                            <li>Product Shoot</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h2>Advertisement</h2>
                        <ul>
                            <li>Meta Ads</li>
                            <li>Google Ads</li>
                            <li>Retargeting Ads</li>
                            <li>Campaign Report</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
