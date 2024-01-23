<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\View\View;
use App\Models\CategoryApp;

class AdminController extends Controller
{
    public function index(): View
    {
        
        $allCategories = CategoryApp::all();
        return view('admin',[
            'allcat' => $allCategories
        ]);
    }
}
