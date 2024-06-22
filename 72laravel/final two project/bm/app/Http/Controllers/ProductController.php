<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\insertProdctRequest;
use App\Product;
use Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(insertProdctRequest $request)
    {
          $files=$request->file('file');
          $filesAry=[];
          foreach($files as $file){
              $newName=uniqid()."_".$file->getClientOriginalName();
              $file->move(public_path()."/uploads/",$newName);
              array_push($filesAry,$newName);

          }
             Product::create([
            'title'=>$request->get('title'),
            'description'=>$request->get('description'),
            'prices'=>$request->get('price'),
            'writer'=>$request->get('writer'),
            'imgs'=>serialize($filesAry)
        ]);
                return redirect('products/create')->with('status','Successfully Insert');
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
    public function update(Request $request, $id)
    {
        //
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
