<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PostController extends Controller
{
    public function indexDeleted(Request $request)
    {
        $products = product::get();

        if($request->has('view_deleted'))
        {
            $products = Post::onlyTrashed()->get();
        }

        return view('products/indexDeleted', compact('products'));
    }

    public function delete($id)
    {
        Post::find($id)->delete();

        return back()->with('success', 'Post Deleted successfully');
    }

    public function restore($id)
    {
        Post::withTrashed()->find($id)->restore();

        return back()->with('success', 'Post Restore successfully');
    }

    public function restore_all()
    {
        Post::onlyTrashed()->restore();

        return back()->with('success', 'All Post Restored successfully');
    }
}