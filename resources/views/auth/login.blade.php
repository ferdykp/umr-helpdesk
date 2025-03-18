@extends('layouts.auth')
@section('content')
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('assets/img/ml-all.png') }}" alt="Gambar" alt="login form"
                                    class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-4 text-black">

                                    <form action="{{route('auth.login')}}" method="POST">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img src="{{ 'assets/img/logo-master.png' }}" class="mx-auto d-block" alt="">
                                        </div>

                                        <h5 class=" mb-3 pb-3 text-center" style="letter-spacing: 1px;">Sign into
                                            your account
                                        </h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Username</label>
                                            <input type="username" name="username" value="{{ old('username', '') }}"
                                                required="required" id="form2Example17"
                                                class="form-control form-control-lg" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input type="password" name="password" id="password" required="required"
                                                autocomplete="current-password" id="form2Example27"
                                                class="form-control form-control-lg" />
                                            <input type="checkbox" id="showPassword" class="mt-4"
                                                onclick="togglePassword()">
                                            <label for="showPassword">Show Password</label>

                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        {{-- <a class="small text-muted" href="#!">Forgot password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                                                style="color: #393f81;">Register here</a></p>
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a> --}}
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function togglePassword() {
                var passwordField = document.getElementById("password");
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                } else {
                    passwordField.type = "password";
                }
            }
        </script>
</section>@endsection