@extends('layouts.app')

@section('content')

<div class="container login_container">
<div class="row"></div>
 <div class="row " style="margin-top:60px">
 <div class="col-md-3"></div>
    <div class="col-md-6 ">
        <h3 class="login_heading">REGISTER</h3>
        <div class="card logincard">
                <div class="card-body">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                     <div class="row mb-3 d-flex justify-content-center">
                    <div class="col-md-12">
                     <input placeholder="Enter Name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <div class="col-md-12">
                            <input placeholder="Enter Email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                     <div class="row mb-3 d-flex justify-content-center">
                          <div class="col-md-12">
                            <input placeholder="Enter Phone No" name="phoneno"  type="text" class="form-control @error('phoneno') is-invalid @enderror" value="{{ old('phoneno') }}" required autocomplete="phoneno" autofocus>
                            @error('phoneno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>   
                    <div class="row mb-3 d-flex justify-content-center">
                          <div class="col-md-12">
                            <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>          

                    <div class="row mb-3 d-flex justify-content-center">
                          <div class="col-md-12">
                           
                            <input id="password-confirm" placeholder="Enter Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                           
                        </div>
                    </div>        
                    <div class="row mb-3 d-flex justify-content-center">
                          <div class="col-md-12">
                             <input 
                                type="file" 
                                id="image-upload" 
                                name="image" 
                                accept="image/*" 
                               
                            >   
                        </div>
                    </div>     
                   

                    <div class="row mb-3 ">
                        <div class="col-md-12">
                            <button type="submit" class="btn" style="background-color:#00cc99; color:white; font-weight:bold">
                               Register
                            </button>
                        </div>
                    </div>
                </form>
                  
                    
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-3"></div>
    
</div>

@endsection
