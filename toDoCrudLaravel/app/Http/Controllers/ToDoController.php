<?php

namespace App\Http\Controllers;

use App\Models\ToDoModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $model = ToDoModels::all();
        return view('index',compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validate the input
        $validator = Validator::make($request->all(), [
            'text' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 400,'error' => $validator->errors()]);
        }
    
        // insert the ToDo
        try {
            ToDoModels::create([
                'text' => $request->text,
            ]);
            Session::flash('message', 'Successfully Inserted!'); 
            return response()->json(['status' => 200,'success' => 'Successfully Inserted!','redirect' => url()->previous()]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500,'error' =>$e->getMessage(),'redirect' => url()->previous()]);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(ToDoModels $toDoModels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToDoModels $toDoModels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToDoModels $toDoModels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = ToDoModels::findOrFail($id);
        $model->delete();
        return redirect()->back()->with('message','Succesfuly deleted..!');
    }
}
