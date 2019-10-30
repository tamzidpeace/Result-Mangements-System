<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(isset($data['reg_no'])) {
            session()->flash('who',2);
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'reg_no' => ['required','numeric'],
                'session' => ['required','numeric'],
                'address' => ['required'],
            ]);
        }
        session()->flash('who',1);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(isset($data['reg_no'])){
            $user = new \App\User;
            $student = new \App\Student;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $student->reg_no = $data['reg_no'];
            $reg = $data['reg_no'];
            $code = strrev($reg);
            $student->code = $code;
            $student->session = $data['session'];
            $student->address = $data['address'];
            $student->department_id = $data['department'];
            $student->save();
            $student->user()->save($user);
            for($i = 1; $i<9;$i++){
                $cgpa = new \App\Cgpa;
                $cgpa->semester = $i;
                $cgpa->gpa = 0;
                $student->cgpas()->save($cgpa);
            }
            return $user;

        }
        $user = new \App\User;
        $teacher = new \App\Teacher;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $teacher->phone = $data['phone'];
        $teacher->approved = 0;
        $teacher->save();
        $teacher->user()->save($user);
        return $user;
    }
}
