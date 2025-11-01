<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        return view('pages.categories.index', compact('categories'));
    }
    
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        $products = $category->products()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->paginate(12);
            
        return view('pages.categories.show', compact('category', 'products'));
    }
}
