<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Category::where('user_id',Auth::id())->with('clothe')->get());

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
        $new_category = new Category();
        $new_category->user_id = Auth::id();
        $new_category->title = $request->title;
        $new_category->save();
        return response()->json($new_category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Category::find($id));
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
        $old_category = Category::find($id);
        $old_category->user_id = Auth::id();
        $old_category->title = $request->title;
        $old_category->save();
        return response()->json($old_category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old_category = Category::find($id);
        $old_category->delete();
        return response()->json('Category Delete Successfully');
    }

    public function search($param)
    {
        $category = Category::where('title','like',"%".$param."%")->get();
        return response()->json($category);

    }

}
