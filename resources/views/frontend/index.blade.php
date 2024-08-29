@extends('layouts.app')
@section('title', 'Welcome to GISA')
@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="mt-md-4">
                        <div>
                            <span class="text-white-50 ms-1">1001% Trusted Insurance Partner</span>
                        </div>
                        <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                            Welcome to GISA!
                        </h2>
                        <h3 class="text-white fw-normal mb-4 mt-3 hero-title">Trust in our expertise to protect what matters most to you.</h3>
                        <p class="mb-4 font-16 text-white-50">At GISA, we're dedicated to safeguarding what matters most to you. Explore our range of insurance products tailored to fit your needs. Trust us to protect your future today.</p>

                        <a href="{{ route('register') }}" class="btn btn-success">Get Started <i
                                class="mdi mdi-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="text-md-end mt-3 mt-md-0">
                        <img src="assets/images/startup.svg" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
