<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;
use Illuminate\Http\Request;
use DB;
use Auth;

class FoodMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return View::make('food.food_view');
    }

    public function storefood(Request $request)
    {
        
        date_default_timezone_set('Asia/Kuala_Lumpur');
        // dd($request->all());
        $result = DB::table('recipes')->insert([
            'user_id' => Auth::user()->id,
            'label' => $request->label,
            'image_path' => $request->image_path,
            'healthLabels' => $request->healthLabels,
            "created_at" =>  date('Y-m-d H:i:s'), 
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

         return redirect('/recipes')->with('message','success');
    }

    public function getRecipes(Request $request)
    {
        $user_id = Auth::user()->id;

        $results = DB::table('recipes')->where('user_id',$user_id)->orderBy('created_at','asc')->get();
        // echo "<pre>";
        // print_r($results);
        // echo "</pre>";
        
        //   print_r($results);
        
        
        return view('food.recipes_view')->with('recipes',$results) ;
    }

    public function deleteRecipes(Request $request){
        $id = $request->id;
        DB::table('recipes')->delete($id);
        return redirect('/recipes')->with('message','Remove successfully');
    }
}
