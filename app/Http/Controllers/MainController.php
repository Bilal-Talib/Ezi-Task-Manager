<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Task;
use Validator;
use App\Http\Resources\TaskResource;
use App\Mail\taskMail;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function main()
    {
        $task = User::where('role_as', '1')->get();
        return view('index',compact('task'));
    }
    public function regindex()
    {
        return view('register');
    }
    public function logindex()
    {
        return view('login');
    }
    public function index(): JsonResponse
    {
        $task = Task::all();
        return response()->json($task);
    }
    protected function sendError($error, $errorMessages = [], $status = Response::HTTP_BAD_REQUEST)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $status);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accessToken = $request->cookie('access_token');
        if($accessToken == null){
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $user = User::where('remember_token', $accessToken)->first();
        if($user->role_as != 0){
            return redirect()->route('main');
        }
        else
        {
        $input = $request->all();
        $validator = $request->validate([
            'title' => 'required',
            'desp' => 'required',
            'assigned' => 'required',
            'status' => 'required',
        ]);
        Mail::to($validator['assigned'])->send(new taskMail($validator));  
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
        $task = Task::create($input);
       
    //    return response()->json($task, 201);
        return redirect('/api/main');
    }
    } 
     
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $user = User::where('remember_token', $accessToken)->first();
        $accessToken = $request->cookie('access_token');
        if($accessToken == null){
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        else
        $task = Task::find($id);
        if (is_null($task)) {
            return $this->sendError('Task not found.');
        }
        return response()->json($task, 201);
    }
      
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateindex(Request $request,$id)
    {
        $task = User::where('role_as', '1')->get();
        $data=Task::where('id',$id)->first();
        return view('update',compact('task','data'));
    }


    public function UpdateData(Request $req,$id){
       $findEntry = Task::find($id);
       $findEntry->update([
            "title" => $req->input('title'),
            "desp" => $req->input('desp'),
            "status" => $req->input('status'),
            "assigned" => $req->input('assigned'),
           
       ]);

       return redirect('/api/main');

    }

    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();
    
        $record = Task::findOrFail($id);
    
        $validator = Validator::make($input, [
            'title' => 'required',
            'desp' => 'required',
            'assigned' => 'required',
            'status' => 'required',
        ]);
    
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $record->update($input);
    
        return response()->json($record, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Task::findOrFail($id);
        $record->delete();
        // return response()->json($record, 201);
        return redirect('/api/main');
    }

}
