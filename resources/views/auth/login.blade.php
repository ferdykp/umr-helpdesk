@extends('layouts.auth')
@section('content')
<main class="main-content mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start text-center">
                                <!-- Kotak teks responsif -->
                                <div style="
                            background: rgba(121, 0, 0, 0.7);
                            padding: 10px 20px;
                            border-radius: 6px;
                            color: #ffffff;
                            font-weight: bold;
                            display: inline-block;
                            margin-bottom: 10px;
                            max-width: 90%;
                            font-size: clamp(16px, 3vw, 24px);
                            text-wrap: balance;
                        ">
                                    Here, There and Everywhere
                                </div>

                                <h4 class="font-weight-bolder mt-4">Sign In</h4>
                                <p class="mb-0">Enter your email and password to sign in</p>
                            </div>
                            <div class="card-body">
                                <form action="{{route('auth.login')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" name="email" value="{{ old('email', '') }}"
                                            required="required" class="form-control form-control-lg"
                                            placeholder="Email" aria-label="Email">
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <input type="password" name="password" id="password" required="required"
                                            autocomplete="current-password" class="form-control form-control-lg"
                                            placeholder="Password" aria-label="Password">
                                        <input type="checkbox" id="showPassword" class="mt-4"
                                            onclick="togglePassword()">
                                        <label for="showPassword">Show Password</label>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign
                                            in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Background Gambar -->
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                            style="background-image: url('/assets/img/mining.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection