<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('category.index',['categories'=>$categories]);
    }

    public function show($id){
        $category=Category::findOrFail($id);
        return view('category.show',['category'=>$category]);

    }

    public function create(){
        return view('category.create');
    }
    public function store(Request $request){
        $request->validate([
            'namecat'=>'required|string '
        ]);
        $name=$request->namecat;
        Category::create([
            'namecat'=>$name
        ]);

        return redirect(route('category.index'));
    }

    public function edit($id){
        $category=Category::findOrFail($id);
        return view('category.edit',['category'=>$category]);

    }

    public function update(Request $request,$id){
       $request->validate([
        'namecat'=>'required|string '
       ]);
       $name=$request->namecat;

       Category::findOrFail($id)->update([
        'namecat'=>$name
       ]);
       return redirect(route('category.index'));
    }

    public function delete($id){
        $category=Category::findOrFail($id)->delete();
        return redirect(route('category.index'));

    }
}
