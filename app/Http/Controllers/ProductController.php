<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::simplePaginate(15);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $attribute = request()->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required'],
            'category_id' => ['required'],
            'description' => ['max:255'],
            'thumb_image' => ['image|max:256'],
        ]);

        $path = storage_path('app/public/images');
        if ($request->hasFile('thumb_image')) {
            $thumbImage = $request->file('thumb_image');
            $imageName =
                $thumbImage->getClientOriginalname();
            $thumbImage->move($path, $imageName);
            $thumb_image = $imageName;
        } else {
            $thumb_image = $request->thumb_image;
        }

        if ($attribute) {
            Product::create(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category_id' => $request->category_id,
                    'thumb_image' =>  $thumb_image,
                ]
            );
        }
        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'id', 'categories'));
    }


    public function update(Request $request, string $id)
    {
        $attribute = request()->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'max:12'],
            'category_id' => ['required'],
            'description' => ['max:255'],
            'thumb_image' => ['max:200000'],
        ]);
        $product =  Product::findOrFail($id);
        $existingImage = $product->thumb_image;
        $path = storage_path('app/public/images');
        if ($request->hasFile('thumb_image')) {
            $thumbImage = $request->file('thumb_image');
            $imageName =
                $thumbImage->getClientOriginalname();
            $thumbImage->move($path, $imageName);
            $thumb_image = $imageName;

            if ($existingImage) {
                unlink($path . '/' . $existingImage);
            }
        } else {
            $thumb_image =  $existingImage;
        }


        if ($attribute) {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'thumb_image' => $thumb_image,
            ]);
        }
        return redirect()->route('products.index')->with('success', 'Product Update Successfully');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Record deleted Successfully');
    }
}
