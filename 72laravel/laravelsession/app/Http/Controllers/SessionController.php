<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(){
        return view('home');
    }
    public function putSession(Request $request){
     $request->session()->put('name','zenye');
     return redirect('/')->with('status','Successfully set single session');
    }
    public function allSession(Request $request){
        $all=$request->session()->all();
        return $all;
    }
    public function multipleSet(Request $request){
        $request->session()->put(['age'=>18,'work'=>'programmer']);
        return redirect('/')->with('status',"Multiple Inserted successful!");
    }
    public function getSession(Request $request){
        $name=$request->session()->get('name');
        return redirect('/')->with('status',$name);
    }
    public function deleteSession(Request $request){
        $request->session()->flush();
        return redirect('/')->with('status','Deleted Successful');
    }
}
