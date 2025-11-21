@extends('layouts.main.master')

@section('content')

{{-- RIGHT CONTENT --}}

<div style="margin-top:20px"></div>
<div class="content">
    <h2>User Profile</h2>
    <div class="row">
        <div class="col-md-3">            
            <img src="{{ asset('assets/img/' . $user->image) }}" 
            class="rounded-circle img-fluid" 
            style="width: 150px; height:150px; object-fit: cover;"
            alt="User Image">         
            
        </div>
        
    </div>
    
    <div class="row mt-4"> 
        
        <div class="col-md-6">
            
            <lable>Name</lable>
            <input  class="form-control" value="{{$user->name}}" readonly/>
            
            
        </div>
        <div class="col-md-6">
            <lable>Email</lable>
            <input  class="form-control" value="{{$user->email}}" readonly/>
            
            
        </div>
    </div>
    
    <div class="row mt-4"> 
        <div class="col-md-6">
            <lable>Phone number</lable>
            <input  class="form-control " value={{$user->phoneno}} readonly/>
            
            
        </div>
        <div class="col-md-6 mt-3"> <a href="{{ route('edituser',$user->id) }}" class="btn mt-1" style="background-color:#00cc99; color:white; font-weight:bold">
            Edit Profile
        </a></div>
        
    </div>
    
        
</div>
</div>
</div>




@endsection








