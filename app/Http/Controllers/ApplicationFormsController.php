<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CategoryApp;
use Illuminate\Support\Facades\Auth;
use App\Models\ApplicationForms;

class ApplicationFormsController extends Controller
{
    
    public function index(): View
    {
        $userApp = ApplicationForms::where('users',  Auth::id())->get();
        $cat = CategoryApp::all();
        return view('backoffice', [
            'allcat' => $cat,
            'id' => Auth::id(),
            'applications' => $userApp
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'cat_id' => 'required',
            'id' => 'required',
        ]);
        $app = new ApplicationForms();
        $app->name = $request->input('title');
        $app->description = $request->input('description');
        $app->category_apps = $request->input('cat_id');
        $app->users = $request->input('id');
        $app->photo = 'photo';
        $app->status = 0;
        $app->save();
        return redirect()->route('backoffice');
    }


}
