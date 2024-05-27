    @extends('layouts/blankLayout')

    @section('title', 'Register Basic - Pages')

    @section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">

    @endsection


    @section('content')

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Register Card -->
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5 max-width-600">
                        <a href="{{url('/')}}" class="app-brand-link gap-2">
                            <div class="text-center">
                                <span class=" app-brand-text demo text-heading fw-semibold text-wrap">Catering Services
                                    Management System
                                </span>
                            </div>
                        </a>
                    </div>
                    <hr>

                    <div class="text-center">
                        <span class="app-brand-text fw-semibold fs-8">Registration</span>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-2">

                        <form id="registerForm" class="mb-3">
                            @csrf
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    placeholder="Enter your fullname" autofocus>
                                <label for="fullname">Fullname</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email">
                                <label for="email">Email</label>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="contact" name="contact"
                                    placeholder="Enter your contact" autofocus>
                                <label for="contact">Contact</label>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-2 form-floating form-floating-outline">
                                    <select class="form-select" id="role" name="role" placeholder="Role"
                                        aria-label="Default select example">
                                        <option selected> </option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnregister">Save</button>
                        </form>
                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{url('/')}}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
                <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree"
                    class="authentication-image-object-left d-none d-lg-block">
                <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}"
                    class="authentication-image d-none d-lg-block" alt="triangle-bg">
                <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree"
                    class="authentication-image-object-right d-none d-lg-block">
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/register.js') }}"></script>
    @endsection