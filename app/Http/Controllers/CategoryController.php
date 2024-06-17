<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

$categories = Category::whereHas('contacts', function ($query) {
    $query->where('user_id', Auth::id());
})->withCount(['contacts' => function ($query) {
    $query->where('user_id', Auth::id());
}])->orderBy('name', 'ASC')->get();
class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::all();
        return view('categories._index', compact('categories'));
    }
    public function show(Category $category)
    {
        $contacts = $category->contacts()->orderBy('created_at', 'DESC')->get();
        return view('categories.show', compact('category', 'contacts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('contacts.create', compact('categories'));
    }


}
