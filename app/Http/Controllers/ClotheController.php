<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Clothe;


use Illuminate\Http\Request;

class ClotheController extends Controller
{
    /**
   
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Clothe::where('user_id',Auth::id())->with('category')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_clothe = new Clothe();
        $new_clothe->user_id = Auth::id();
        $new_clothe->category_id = $request->category_id;
        $new_clothe->code = $request->code;
        $new_clothe->age = $request->age;
        $new_clothe->price = $request->price;
        $new_clothe->save();
        return response()->json($new_clothe);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Clothe::find($id));
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
        $old_clothe = Clothe::find($id);
        $old_clothe->user_id = Auth::id();
        $old_clothe->category_id = $request->category_id;
        $old_clothe->code = $request->code;
        $old_clothe->age = $request->age;
        $old_clothe->price = $request->price;
        $old_clothe->save();
        return response()->json($old_clothe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old_clothe = Clothe::find($id);
        $old_clothe->delete();
        return response()->json('Clothe Delete Successfully');
    }
}
