<?php

namespace App\Http\Controllers;

use App\Diary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $diaries=Diary::where("user_id",Auth::id())->get();
        $events=[];
        foreach($diaries as $diary){
            $events[$diary->date][]=["time"=>$diary->time,"status"=>$diary->status];
        }
        return view('home',compact('events'));
    }

    public function write(Request $request)
    {

        $diary=new Diary();
        $diary->status=$request->request->get("status");
        $diary->date=$request->request->get("date");
        $diary->time=$request->request->get("time");
        $diary->user_id=Auth::id();
        $diary->momentum=$request->request->get("momentum");
        $diary->save();

        return redirect('/');
    }


    public function chart()
    {

        $dossari=Diary::where("user_id",Auth::id())->where('status',"どっさり")->count();
        $geri=Diary::where("user_id",Auth::id())->where('status',"下痢")->count();
        $benpi=Diary::where("user_id",Auth::id())->where('status',"便秘")->count();
        $sukoshi=Diary::where("user_id",Auth::id())->where('status',"少し")->count();
        $seiri=Diary::where("user_id",Auth::id())->where('status',"生理")->count();

        return view('chart',compact('dossari','geri','benpi','sukoshi','seiri'));
    }
}
