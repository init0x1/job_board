<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::paginate(10);
        return view('admin.categories.list', compact('categories'));
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
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128|unique:categories,name',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
        }

        Category::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.list')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB Max
        ]);

        // Handle image upload
        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }
            $imagePath = $request->file('image')->store('category_images', 'public');
        }

        // Update the category
        $category->update([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.list')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            Storage::delete('public/' . $category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.list')->with('success', 'Category deleted successfully.');
    }
}
