<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryApp;


class CategoryAppController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'catname' => 'required|string|max:255',
        ]);
        $category = new CategoryApp();
        $category->name = $request->input('catname');
        $category->save();
        return redirect()->route('admin');
    }

    public function getAllCategories(){
        $allCategories = CategoryApp::all();
        dd($allCategories);
    }

}
