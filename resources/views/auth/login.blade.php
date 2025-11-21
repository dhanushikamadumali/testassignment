@extends('layouts.app')

@section('content')
<div class="container login_container">
<div class="row"></div>
 <div class="row " style="margin-top:60px">
 <div class="col-md-3"></div>
    <div class="col-md-6 ">
        <h3 class="login_heading">LOGIN</h3>
        <div class="card logincard">
                <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-3 d-flex justify-content-center">
                        <div class="col-md-12">
                            <input placeholder="Enter Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 d-flex justify-content-center">
                          <div class="col-md-12">
                            <input placeholder="Enter Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                  

                    <div class="row mb-3 ">
                        <div class="col-md-12">
                            <button type="submit" class="btn login-button" style="background-color:#00cc99; color:white; font-weight:bold">
                               Login
                            </button>
                        </div>
                    </div>
                </form>
                  <div class="row mb-0">
                    @guest
                    <div class="col-md-12">
                        <a href="{{ route('register') }}" class="btn login-button" style="background-color:#00cc99; color:white; font-weight:bold">
                           Register
                        </a>                      
                    </div>
                    @endguest
                   
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-3"></div>
    
</div>

@endsection
