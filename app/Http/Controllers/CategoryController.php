<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::all();

        $categoryUpdated = $categories->map(function ($q) {
            $q->name = \Illuminate\Support\Str::limit($q->name, 25);
            $q->action_button = '<a href="' . url('categories/' . $q->id . '/edit') . '"><button class="btn btn-primary">Edit</button></a>' . ' ' . '<form action="' . route('categories.destroy', ['category' => $q->id]) . '" method="POST" style="display:inline;">
            ' . csrf_field() . '
            ' . method_field('DELETE') . '
            <button type="submit" class="btn btn-danger">Delete</button>
         </form>';
            //     $q->delete_button = '<form action="' . route('categories.destroy', ['category' => $q->id]) . '" method="POST" style="display:inline;">
            //     ' . csrf_field() . '
            //     ' . method_field('DELETE') . '
            //     <button type="submit" class="btn btn-danger">Delete</button>
            //  </form>';

            return $q;
        });
        if ($request->ajax()) {
            return response()->json(['data' => $categories]);
        }

        return view('categories.index');
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
