<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of all the categoriess.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created category in library.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:25'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return Category::create($validator->validated());
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified category in library.
     */
    public function update($id, Request $request)
    {
        $category = Category::find($id);
        if ($category == null) {
            return response()->json(['errors' => 'Category Not Found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:25'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $category->update($validator->validated());
        return $category;
    }

    /**
     * Remove the specified category from library.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return response()->json(['errors' => 'Category Not Found'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
