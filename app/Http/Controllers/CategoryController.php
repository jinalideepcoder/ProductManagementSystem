<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('categories.index', ['categories' => $category]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $attribute = request()->validate([
            'name' => ['required', 'max:255'],
        ]);

        Category::create($attribute);
        return redirect()->route('categories.index')->with('success', 'Category Added Successfully');
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category', 'id'));
    }


    public function update(Request $request, string $id)
    {
        $attribute = request()->validate([
            'name' => ['required']
        ]);

        $category =  Category::findOrFail($id);
        $category->update($attribute);
        return redirect()->route('categories.index')->with('success', 'Category Update Successfully');
    }

    public function destroy(string $id)
    {
        $category =  Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Record deleted Successfully');
    }
}
