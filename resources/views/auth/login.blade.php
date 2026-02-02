@extends('layouts.master-without-nav')
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="{{ url('index') }}" class="mb-5 d-block auth-logo">
                            <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="60"
                                class="logo logo-dark">
                            <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="60"
                                class="logo logo-light">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to 3dweldmesh.</p>
                            </div>
                            <div class="p-2 mt-4">
                                @if(Session::has('message'))
                                <div class="alert alert-danger">{{Session::get('message')}}</div>
                                @endif
                                @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                                @endif
                                <form method="POST" action="{{route('authenticate')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email"
                                            placeholder="Enter Email address">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                         name="password" id="userpassword" placeholder="Enter password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>© <script>
                                document.write(new Date().getFullYear())

                            </script> 3dweldmesh. Crafted by DigiealgeINC</p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
