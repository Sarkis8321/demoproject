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

    public function deleteCatById($id){
        $delCat = CategoryApp::find($id)->delete();
        $arr = array();
        $arr['isErr'] = false;
        $arr['text'] = '';
       
        if ($delCat){
            $arr['text'] = 'Данные успешно удалены!';
        } else {
            $arr['isErr'] = true;
            $arr['text'] = 'Произошла ошибка на сервере, попробуйте позже!';
        }
        return json_encode($arr);
    }


}
