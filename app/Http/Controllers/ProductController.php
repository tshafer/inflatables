<?php namespace App\Http\Controllers;

use App\Category;
use App\Product;

/**
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{

    /**
     * @param \App\Category $category
     * @param \App\Product  $product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category, Product $product)
    {
        if ( ! $category->enabled) {
            return redirect()->back();
        }
        
        if ( ! $product->enabled) {
            return redirect()->back();
        }

        return view('product', compact('category', 'product'));
    }
}
