<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;

$aT=NULL;
class RegisterController extends BaseController
{
    
    public function main(Request $request)
    {
        // $accessToken = $request->cookie('access_token');
        $_COOKIE['access_token'] = $request->cookie('access_token');
        $tokencheck = $_COOKIE['access_token'];
        if($_COOKIE['access_token'] =! null)
        {
            $userdata= User::where('remember_token', $tokencheck)->first();
            if($userdata->role_as ==0)
            {
                $data = Task::all();
                $task = User::where('role_as', '1')->get();
                return view('AdminDashboard',compact('task','data','userdata'));
            }
            elseif($userdata->role_as ==1)
            {
                $data = Task::where('assigned', $userdata->id)->get();
                // $task = User::where('role_as', '1')->get();
                $task = Task::all();

                return view('user',compact('task','data','userdata'));
            }
            elseif($userdata->role_as ==2)
            {
                $data = Task::where('assigned', $userdata->id)->get();
                // $task = User::where('role_as', '1')->get();
                $task = Task::all();
                return view('ManagerDashboard',compact('task','data','userdata'));
            }
        }
        else{
            return view('login');
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //     ]);
   
    //     if($validator->fails()){
    //         return $this->sendError('Validation Error.', $validator->errors());       
    //     }
   
    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);
    //     $token = Str::random(60);
    //     $user->remember_token = $token;
    //     $user->save();
    //     $success['token2'] =  $token;
    //     $success['token'] =  $user->createToken('MyApp')->accessToken;
    //     $success['name'] =  $user->name;
   
    //     return $this->sendResponse($success, 'User register successfully.');
    // }
   
    // /**
    //  * Login api
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function login(Request $request)
    // {
    //     if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
    //         $user = Auth::user(); 
    //         // $user->remember_token = $token;
    //         // $user->save();
    //         $token = Str::random(60);
    //         $success['token'] =  $user->createToken('MyApp')-> accessToken; 
    //         $success['token2'] =  $token;
    //         $success['name'] =  $user->name;
   
    //         return $this->sendResponse($success, 'User login successfully.');
    //     } 
    //     else{ 
    //         return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    //     } 
    // }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

     


   
        // return $this->sendResponse($success, 'User register successfully.');



        return redirect('/api/main');
        
    }
     
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    // public function login(Request $request)
    // {
    //     if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
    //         $user = Auth::user(); 
    //         $success['token'] =  $user->createToken('MyApp')-> accessToken; 
    //         $success['name'] =  $user->name;
   
    //         // return $this->sendResponse($success, 'User login successfully.');
    //         return view('index');
    //     } 
    //     else{ 
    //         return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    //     } 
    // }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { 
            $user = Auth::user(); 
            $token = $user->createToken('MyApp')->accessToken; 
            $_COOKIE['access_token'] = $token;

            // session(['access_token' => $token]);
            // return response()->json(['token' => $token, 'name' => $user->name]);
            $user->remember_token = $token;
            $user->token_expires_at = now()->addMinutes(10);
            $user->save();
            return redirect()->route('main')->cookie('access_token', $token, config('session.lifetime'));
        } else { 
            return view('login');
        } 
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
        }
        $response = redirect()->route('logindex')->withCookie(cookie()->forget('access_token'));
    
        return $response;
    }

   
}
