<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Get category lists.
     *
     * @param  none
     * @return Array category
     */
    protected function index()
    {
        $ctegories = Category::all();
        return response()->json(['success' => true, 'categories' => $ctegories]);
    }

    /**
     * Get a category.
     *
     * @param  category slug or id
     * @return Object category
     */
    protected function show(Request $request)
    {
        $category = Category::findBySlug($request->id);
        $courses = $category->courses()->select('title', 'image', 'course_id')->get();
        return response()->json(['success' => true, 'category' => $category, 'courses' => $courses]);
    }
}
