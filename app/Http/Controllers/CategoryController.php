<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_user()
    {
        $categories = Category::all();
        return view('globalPages.categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show_user(Category $category) // Route Model Binding automatically resolves $category
    {
        return view('globalPages.categories.show', compact('category'));
    }

    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) // Route Model Binding automatically resolves $category
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
