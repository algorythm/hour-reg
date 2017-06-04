<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function showCategories() {
      $categories = Category::all();
      return view('categories')->with('categories', $categories);
    }

    public function createCategory(Request $req) {
      $validator = Validator::make($req->all(), [
        'name' => 'required|max:255',
      ]);

      if (!$validator->fails()) {
        echo $req->name;
        Category::create([
          'name' => $req->name,
        ]);

        return redirect('/categories');
      }

      //Category::create([
//        'name' => $req['name'],
      //]);
    }
}
