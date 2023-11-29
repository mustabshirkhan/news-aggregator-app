<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

class UserController extends Controller
{
    //
    public function assignCategories(Request $request)
    {
        $user = Auth::user();
        $categoryIds = $request->input('category_ids', []);
        $user->categories()->syncWithoutDetaching($categoryIds);
        return response()->json(['message' => 'Categories assigned successfully']);
    }

    public function getCategories(Request $request)
    {
        $user = Auth::user();
        $categories = $user->categories;
        return response()->json(['data' => $categories]);
    }
}
