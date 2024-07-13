<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Flasher\Toastr\Prime\ToastrInterface;

class TodoController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $taske = task::where('user_id',$user_id)->get();
        $is_Empty = $taske->isEmpty();
        return view('Home',compact('taske','is_Empty'));
    }

    public function task()
    {
        return view('add_task');    
    }

    public function add_task(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'task' => 'required',
        ],[
            'task.required' => 'Enter Your Task',
        ]);

        if($validator->passes())
        {
            $taske = new task;
            $taske->task = $request->task;
            $taske->user_id = Auth::user()->id;
            $taske->save();
            toastr()->closeButton(true)->success('Your Task Added.');
            return redirect()->route('home');
        }
        else
        {
            return redirect()
                ->route('home')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function register()
    {
        return view('register');
    }

    public function verify_registration(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ],[
            'name.required' => 'Enter Your Name',
            'email.required' => 'Enter Your Email',
            'email.email' => 'Enter valid email',
            'email.unique' => 'User already exists',
            'password.required' => 'Enter Password',
            'password.min' => 'Password Must Be More Than 8 Characters',
            'password.confirmed' => 'Password And Confirm Password Are Not Same',
        ]);

        if($validator->passes())
        {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            toastr()->closeButton(true)->success('Registered Succesfully');
            return redirect()->route('home');
        }
        else
        {   
            return redirect()
                    ->route('register')
                    ->withInput()
                    ->withErrors($validator);
        }
    }

    public function login()
    {
        return view('login');
    }

    public function verify_login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Enter Your Email',
            'email.email' => 'Enter Valid Email',
            'password.required' => 'Enter Your Password'
        ]);

        if($validator->passes())
        {
            if(Auth::attempt(['email' => $request->email , 'password' => $request->password]))
            {
                return redirect()->route('home');
            }
            else
            {
                toastr()->closeButton(true)->error('Either Email Or Password Is Wrong');
                return redirect()->route('login');
            }
        }
        else
        {
            toastr()->closeButton(true)->success('Logged In Succesfully');
            return redirect()
                    ->route('login')
                    ->withInput()
                    ->withErrors($validator);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');       
    }

    public function edit_task($id,Request $request)
    {
        $validator = Validator::make($request->all(),[
            'task' => 'required',
        ],[
            'task.required' => 'Enter Your Task',
        ]);

        if($validator->passes())
        {
            $task = task::find($id);
            $task->task = $request->task;      
            $task->save();
            return redirect()->route('home');   
        }
        else
        {
            return redirect()
                ->route('home')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function task_done($id)
    {
        $task = task::find($id);
        $task->status = 'done';      
        $task->save();
        return redirect()->route('home');
    }

    public function task_delete($id)
    {
        $task = task::find($id);
        $task->delete();
        return redirect()->route('home');
    }

}
