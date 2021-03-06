<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;
use Illuminate\Http\Request;
use DB;
use Auth;

class BMIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return View::make('bmi.bmi_view');
    }

    public function storebmi(Request $request)
    {
        date_default_timezone_set('Asia/Kuala_Lumpur');
        // dd($request->all());
        $result = DB::table('bmi_history')->insert([
            'weight' => $request->weight,
            'user_id' => Auth::user()->id,
            'height' => $request->height,
            'bmi' => $request->bmi,
            'date' => $request->date,
            "created_at" =>  date('Y-m-d H:i:s'), 
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        return redirect('/bmi')->with('message','success');
    }

    public function getChart(Request $request)
    {
        $user_id = Auth::user()->id;

        $results = DB::table('bmi_history')->where('user_id',$user_id)->orderBy('date','asc')->get();
        // echo "<pre>";
        // print_r($results);
        // echo "</pre>";
        $dataPoints = [];
        // print_r($results);
        foreach($results as $result):
           $dataPoints[] = [
               "y" => $result->bmi,
               "label" => $result->date
           ];
        endforeach;
        return View::make('bmi.bmi_history_chart',['data' => $dataPoints]);
    }
}
