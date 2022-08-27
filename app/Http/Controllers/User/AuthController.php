<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamBatch;
use App\Models\Student;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    public function login()
    {
        if(Auth::guard('student')->check()){
            return redirect()->route('dashboard');
        }
        return view('frontend.login');
    }

    public function register()
    {
        if(Auth::guard('student')->check()){
            return redirect()->route('dashboard');
        }
        $category = ExamBatch::all();
        return view('frontend.register', compact('category'));
    }

    public function login_check(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric'
        ]);

        $user = Student::where('user_id', $request->user_id)->first();
        if($user){
            Auth::guard('student')->login($user);
            return redirect()->route('dashboard');
        }

        return redirect()
        ->back()
        ->with('error', 'Invalid Credentials');     

    }

    public function register_check(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'clg_name' => 'required',
            'phone' => 'required|unique:students,phone',
            'payment_number' => 'required',
            'batch_id' => 'required',
            'group' => 'required' 
        ]);

        $data = $request->all();
        $check = $this->create($data);
        if($check){
            $user_id = $check->user_id;
            return response()->json(['user_id' => $user_id]);
        }

    }

    public function create(array $data)
    {
        return Student::create([
            'name' => $data['name'],
            'clg_name' => $data['clg_name'],
            'phone' => $data['phone'],
            'payment_number' => $data['payment_number'],
            'batch_id' => $data['batch_id'],
            'group' => $data['group'],
        ]);
    }

    public function forgot()
    {
        return view('frontend.forgot');
    }

    public function forgot_check(Request $request)
    {
        $request->validate([
            'phone'=> 'required|numeric|exists:students,phone',
        ]);

        $phone = $request->phone;
        $student = Student::where('phone',$phone)->first();
        if($student){
            return response()->json(['name' => $student->name, 'user_id' => $student->user_id]);
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect()->route('user.login');
    }
}
