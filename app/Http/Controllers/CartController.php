<?php namespace App\Http\Controllers;

use App\Unit;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @package App\Http\Controllers
 */
class CartController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        return view('cart');
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $unit = Unit::find($request->get('unit'));

        $category = $unit->product->categories->first();

        $media = ($unit->product->getMedia('products')->count() > 0) ? $unit->product->getMedia('products')->first()->getUrl('thumb') : null;

        $name = strlen($unit->description) > 0 ? $unit->description : $unit->product->name;

        Cart::instance(session('cartId'))->add($unit->id, $name, 1, $unit->price, $unit->weight,  [
            'product_name' => $unit->product->name,
            'image'        => $media,
            'productSlug'  => $unit->product->slug,
            'categorySlug' => $category->slug,
            'width'        => $unit->width,
            'length'       => $unit->length,
            'height'       => $unit->height,
            'model'        => $unit->model,
        ]);

        return redirect()->route('cart.index')->with('backUrl', route('category' ,  [$category->slug]));
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $unitId
     *
     * @return mixed
     */
    public function destroy(Request $request, $unitId)
    {
        Cart::instance(session('cartId'))->remove($unitId);

        return redirect()->route('cart.index')->with('message', 'Item has been removed from your cart.');

    }
}
