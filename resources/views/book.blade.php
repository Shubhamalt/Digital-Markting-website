@extends('layouts.layout')
@section('book')

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a href="index" class="navbar-brand">
                <img class="logo " src="{{ asset('img/logo.png') }}" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-5">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="about">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="book">Book a call</a>
                    </li>
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
                <form action="register" method="post">
                    @csrf
                    <div class="row d-flex align-items-end justify-content-center gap-5">
                        <div class="col-lg-3 col-3">
                            <p>Name</p>
                            <input type="text" class="form-control" placeholder="What's your name" name="name" required>
                        </div>
                        <div class="col-lg-3 col-3">
                            <p>Book</p>
                            <input type="date" class="form-control" name="book" required>
                        </div>
                        <div class="col-lg-3 col-3">
                            <p>Time</p>
                            <input type="time" class="form-control" name="time" required>
                        </div>
                        <div class="col-lg-3 col-3">
                            <p>Email</p>
                            <input type="email" class="form-control" placeholder="name@gmail.com" name="email" required>
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
