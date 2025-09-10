<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $filter = $request->filter;
        $type = '';
        if($filter == 1){
            $type = 'ASC';
        }else if($filter == 2){
            $type = 'DESC';
        }

        $categories = Category::when($search, function($query, $search){
            return $query->where('name', 'like', "%{$search}%");
        })->orWhere('slug', 'like', "%{$search}%")
        ->when($filter !== null && $filter !== '', function($query, $filter) use ($type){
            return $query->orderBy('name', $type);
        })
        ->latest()->paginate(10);
        return view('category.index', compact('categories'));
    }
    public function create(){
        return view('category.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return to_route('categories.index')->withSuccess('Category created successfully');
    }

    public function delete(Category $category){
        $category->delete();
        return to_route('categories.index')->withSuccess('Category deleted successfully');
    }
}