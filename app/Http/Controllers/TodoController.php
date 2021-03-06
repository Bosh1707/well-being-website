<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Todo;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // $todos = Todo::all();
        $user_id = auth()->user()->id;
        $todos = DB::select("SELECT * FROM todos WHERE user_id = $user_id ORDER BY created_at DESC");
        // print_r($request->session());
        return view('todo.index')->with('todos',$todos) ;
        // return "to do index page";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required'
        ]);

        $todo = new Todo;
        $todo->name = $request->input('todo');
        $todo->user_id = auth()->user()->id;
        $todo->complete = 0;
       
        $todo->save();
        // return redirect('todo');
        return redirect('todo')->with('success', 'New todo created successfully'); 
        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $todo = new Todo;
        $todoItem = $todo::find($request->input('todoId'));
       

        if($request->input('complete') == 'Complete'){
            
            $todoItem->complete = 1;
            $todoItem->save();
            return redirect()->back()->with('success', 'Todo set to complete successfully'); 
            
        }else if($request->input('complete') == 'Incomplete'){
            
            $todoItem->complete = 0;
            $todoItem->save();
            return redirect()->back()->with('success', 'Todo set to pending successfully'); 
        }else if($request->input('complete') == 'Delete'){
            $todoItem->delete();
            return redirect()->back()->with('success', 'Record delete successfully'); 
            // return redirect('todo');
        }
        
        // echo $todoItem->complete;
        
     
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
