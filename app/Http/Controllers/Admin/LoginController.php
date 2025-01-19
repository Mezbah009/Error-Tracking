<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

    //--------index
    public function index()
    {
        return view('admin.login');
    }


    //------authenticate----------

    // public function authenticate(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'mobile' => 'required|mobile',
    //         'password' => 'required'
    //     ]);

    //     if (Auth::guard('admin')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->get('remember'))) {
    //         $admin = Auth::guard('admin')->user();

    //         if ($admin->role == 2) {
    //             return redirect()->route('error_trackings.index');
    //         } else {
    //             Auth::guard('admin')->logout();
    //             return redirect()->route('admin.login')->with('error', 'You are not authorized to access admin panel');
    //         }
    //     }

    //     return redirect()->route('admin.login')->with('error', 'Either Phone Number/Password is Incorrect');
    // }



    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile',
            'password' => 'required'
        ]);

        // Member login
        if (Auth::guard('developer')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->get('remember'))) {
            $developer = Auth::guard('developer')->user();

            if ($developer->role == 1) {
                return redirect()->route('developer_error_trackings.index');
            } else if ($developer->role == 2) {
                Auth::guard('developer')->logout();


                if (Auth::guard('admin')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->get('remember'))) {
                    $admin = Auth::guard('admin')->user();

                    if ($admin->role == 2) {
                        return redirect()->route('error_trackings.index');
                    } else {
                        Auth::guard('admin')->logout();
                        return redirect()->route('admin.login')->with('error', 'You are not authorized to access admin panel');
                    }
                }
            } else {
                Auth::guard('developer')->logout();
                return redirect()->route('admin.login')->with('error', 'You are not authorized to access Member panel');
            }
        }

        // Admin login


        return redirect()->route('admin.login')->with('error', 'Either Phone Number/Password is Incorrect');
    }




    // public function authenticate(Request $request)
    // {
    //     // Validate mobile and password fields
    //     $validator = Validator::make($request->all(), [
    //         'mobile' => 'required|mobile',
    //         'password' => 'required'
    //     ]);


    //     // dd('Request Data:', $request->all());

    //     // Member login
    //     if ($this->attemptLogin($request, 'developer', 1)) {
    //         return redirect()->route('developer.dashboard');
    //     }

    //     if ($this->attemptLogin($request, 'admin', 2)) {
    //         return redirect()->route('admin.dashboard');
    //     }

    //     if ($this->attemptLogin($request, 'accountant', 4)) {
    //         return redirect()->route('accountant.dashboard');
    //     }

    //     // If login fails for all guards, return the error message
    //     return redirect()->route('admin.login')->with('error', 'Either Phone Number or Password is Incorrect');
    // }



    //---------edit------------

    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        $users = User::where('id', $admin->id)->get()->first();
        // dd($users);
        return view('admin.profile', compact('users'));
    }


    //--------------update---------------

    public function update(Request $request, $id)
    {
        $users = User::find($id);

        if (empty($users)) {
            session()->flash('error', 'User not found');
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'mobile' => 'required',
            'password' => 'nullable',
            'image' => 'nullable'


        ]);
        // dd($request->password);
        if ($validator->passes()) {
            $users->name = $request->name;
            $users->mobile = $request->mobile;

            if ($request->password != null) {
                $users->password = $request->password;
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $base64Image = base64_encode(file_get_contents($image->path()));
                $users->image =  $base64Image;
            }
            $users->save();

            $request->session()->flash('success', 'User updated successfully');
            return response()->json([
                'status' => true,
                'messege' => 'User updated successfully'
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
                'errors' => $validator->errors()
            ]);
        }
    }


    //-------------logout---------------

    // public function logout()
    // {
    //     Auth::guard('admin')->logout();
    //     return redirect()->route('admin.login');
    // }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }




    //---------------------developer--------------------

    //------------mamager edit--------------------

    public function developer_edit()
    {
        $developer = Auth::guard('developer')->user();
        $users = User::where('id', $developer->id)->get()->first();
        // dd($users);
        return view('developer.profile', compact('users'));
    }

    //----------------manager update----------

    public function developer_update(Request $request, $id)
    {
        $users = User::find($id);

        if (empty($users)) {
            session()->flash('error', 'User not found');
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'mobile' => 'required',
            'password' => 'nullable',
            'image' => 'nullable'


        ]);
        // dd($request->password);
        if ($validator->passes()) {
            $users->name = $request->name;
            $users->mobile = $request->mobile;

            if ($request->password != null) {
                $users->password = $request->password;
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $base64Image = base64_encode(file_get_contents($image->path()));
                $users->image =  $base64Image;
            }
            $users->save();

            $request->session()->flash('success', 'developer updated successfully');
            return response()->json([
                'status' => true,
                'messege' => 'User updated successfully'
            ]);
        } else {
            return response()->json([
                'status'  =>  false,
                'errors' => $validator->errors()
            ]);
        }
    }
}