<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoriesController extends Controller
{
    public function index()
    {
        $blogCategories = BlogCategory::orderBy('id', 'DESC')->get();
        return view('admin.blog.category.index', compact('blogCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $data = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
        ];

        if ($request->has('parent_category')) {
            $isCategoryExist = BlogCategory::where('id', $request->input('parent_category'))->exists();
            $data['parent_id'] = $isCategoryExist ? $request->input('parent_category') : null;
        }

        $blogCategory = BlogCategory::create($data);

        return response([
            'message' => 'Category created successfully',
            'category' => $blogCategory
        ]);
    }

    public function update(Request $request, $categoryId)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $data = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
        ];

        if ($request->has('parent_category')) {
            $isCategoryExist = BlogCategory::where('id', $request->input('parent_category'))->exists();
            $data['parent_id'] = $isCategoryExist ? $request->input('parent_category') : null;
        }

        $blogCategory = BlogCategory::find($categoryId);
        $blogCategory->update($data);

        return response([
            'message' => 'Category updated successfully',
            'category' => $blogCategory
        ]);
    }



    public function categoryViaId($blog_category)
    {
        $blogCategory = BlogCategory::where('id', $blog_category)->first();
        return response([
            'message' => 'Category created successfully',
            'category' => $blogCategory
        ]);
    }

    public function delete($category_id)
    {
        $category = BlogCategory::find($category_id);
        if (!$category) {
            return redirect()->route('admin.blog.categories.index')->with('error', 'Category not found');
        }
        $category->delete();
        return redirect()->route('admin.blog.categories.index')->with('success', 'Category has been deleted successfully');
    }

}