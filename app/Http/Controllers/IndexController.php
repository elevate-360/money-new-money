<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    public function index()
    {
        if (session()->has("user")) {
            $data = DB::table("tblTransection")->orderBy("traDate")->get();
            $sum = DB::table('tblTransection')->select(DB::raw('SUM(traAmount) as total_amount'))->where('traType', 1)->get();
            $totalAmount = $sum[0]->total_amount;
            $sum = DB::table('tblTransection')->select(DB::raw('SUM(traAmount) as spent'))->where('traType', 0)->get();
            $spent = $sum[0]->spent;
            $balance = $totalAmount - $spent;
            $report = ["totalAmount" => $totalAmount, "spent" => $spent, "balance" => $balance];
            $count = 0;
            return view('index', compact('data', 'count', 'report'));
        } else {
            return redirect()->route('login');
        }
    }

    public function data()
    {
        return view('data');
    }

    public function insertData(Request $request)
    {
        $traTitle = $request->input("traTitle");
        $traEntity = $request->input("traEntity");
        $traAmount = $request->input("traAmount");
        $traType = (is_null($request->input("traType")) ? "0" : "1");
        $traMethod = $request->input("traMethod");
        DB::table('tblTransection')->insert([
            'traTitle' => $traTitle,
            'traEntity' => $traEntity,
            'traAmount' => $traAmount,
            'traType' => $traType,
            'traMethod' => $traMethod,
            'traUserId' => session('user')->userId
        ]);

        return redirect()->route('index');
    }
}
