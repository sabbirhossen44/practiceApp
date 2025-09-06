<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('category.index', compact('categories'));
    }
    public function create(){
        return view('category.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return to_route('categories.index');
    }
}
