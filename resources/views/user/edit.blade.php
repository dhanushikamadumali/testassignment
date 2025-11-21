@extends('layouts.main.master')

@section('content')

{{-- RIGHT CONTENT --}}

   

<div style="margin-top:20px"></div>
<div class="content">
    <h2>User Profile Edit</h2>
    <div class="row mt-4">
         <form  method="POST" action="{{ route('updateuser') }}" enctype="multipart/form-data">
            @csrf   
             @method('PUT')
            <input name="id" value={{ $user->id }} type="hidden"/> 
               
                <div class="row mb-3">
                    <div class="col-md-6">
                        <lable>Name</lable>
                         <input placeholder="Enter Name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                     <div class="col-md-6">
                        <lable>Email</lable>
                        <input placeholder="Enter Email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $user->email }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                </div>
          
           
             <div class="row mb-3 ">
                  <div class="col-md-6">
                    <lable>Phone no</lable>
                    <input placeholder="Enter Phone No" name="phoneno"  type="text" class="form-control @error('phoneno') is-invalid @enderror" value="{{ $user->phoneno }}" required autocomplete="phoneno" autofocus>
                    @error('phoneno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                 <div class="col-md-3">
                    <lable>Image</lable>
                     <input 
                        type="file" 
                        id="image-upload" 
                        name="image" 
                        accept="image/*" 
                        
                    /> 
                     </div>  
                      <div class="col-md-3 mt-3">
                         <img src="{{ asset('assets/img/' . $user->image) }}"                    
                        style="width: 50px; height:50px; object-fit: cover;"
                        alt="User Image"/> 
                      </div>
                     
               
                 
            </div>   
                     
          
         

            <div class="row mb-6">
                <div class="col-md-6">
                    <button type="submit" class="btn" style="background-color:#00cc99; color:white; font-weight:bold">
                       Edit
                    </button>
                </div>
            </div>
        </form>
          
    </div>
   
</div>
</div>
</div>

@endsection








