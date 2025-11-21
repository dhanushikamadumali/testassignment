<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;
use Exception;



// use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          
        $id = Auth::id();        
        $user = User::where('id', $id)->first();      
        return view('user.index',compact('user'));
    }
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

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user,$id)
    {       
        $user = $user::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
       
        try{
              $user = User::find($request->id);

            $data = $request->except('image'); // keep other fields

            // If new image uploaded
            if ($request->hasFile('image')) {

                // Delete old image if exists
                if ($user->image && file_exists(public_path('assets/img/' . $user->image))) {
                    unlink(public_path('assets/img/' . $user->image));
                }

                // Upload new image
               
                $file = $request->file('image');
                $filename =  time().'.'.$file->extension();
                $file->move(public_path('assets/img/'), $filename);

                // Save new filename
                $data['image'] = $filename;
            }else{
                // Keep existing image
                $data['image'] = $user->image;
            }

            // Update user
            $user->update($data);


        }catch(Exception $e){
            notify()->error('Failed to User Updated');
        }
        return Redirect::route('user');
    }

}
