<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;
use Exception;


// use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
     public function store(StoreUserRequest $request)
     {
       
         try {
            // Get all validated data
            $data = $request->validated();

            // Handle image upload
            if($request['image']){
                $file = $request['image'];
                
                $imageName = time().'.'.$file->extension();
               
                $file->move(public_path('assets/img'),$imageName);
                
                $data['image'] = $imageName;
            }

          

            // Create user
            $user = User::create($data);   
          

             notify()->success('Successfully Registered', 'Success!', [
                 'position' => 'bottom-right'
             ]);

             return Redirect::route('login');

         } catch (ValidationException $e) {
             // Custom handling for validation errors
             notify()->error('Validation Error: Please check your input.', 'Error', [
                 'position' => 'top-right'
             ]);

             // Optionally, you can log the validation errors for debugging
             Log::error('Validation failed: ', $e->errors());

             // Redirect back with validation errors
             return redirect()->back()->withErrors($e->errors())->withInput();
         } catch (Exception $e) {
             // Custom handling for other types of exceptions
             notify()->error('Failed To Insert UserList.', 'Error', [
                 'position' => 'top-right'
             ]);

             // Log the error for debugging
             Log::error('Error creating user: ' . $e->getMessage());

             return redirect()->back()->withInput();
         }
     }
}
