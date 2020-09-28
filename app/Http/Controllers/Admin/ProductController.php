<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use League\Fractal;

class ProductController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        if ($request->has('featured')) {
            $products = Product::with(['categories', 'categories.media'])->whereFeatured(true)->paginate(100);
        } else {
            $products = Product::with(['categories', 'categories.media'])->paginate(100);
        }

        if ($request->has('category')) {

            $products = Product::with(['categories', 'categories.media'])->whereHas('categories', function ($query) use ($request) {
                $query->where('categories.id', '=', $request->get('category'));
            })->paginate(100);

        }

        $categories = Category::orderBy('name', 'desc')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }


    /**
     * @param \App\Product $product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $nestedList = Category::allLeaves()->orderBy('name')->get()->pluck('name', 'id')->toArray();

        asort($nestedList);

        $parentId = $product->categories()->first();

        $parentId = isset($parentId) ? $parentId->id : null;

        return view('admin.products.edit', compact('product', 'nestedList', 'parentId'));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $nestedList = Category::allLeaves()->orderBy('name')->get()->pluck('name', 'id')->toArray();

        asort($nestedList);

        $parentId = $request->has('cat') ? $request->get('cat') : null;

        return view('admin.products.create', compact('nestedList', 'parentId'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $rules   = [
            'name' => 'bail|required|unique:products',
        ];
        $product = $this->runSave($request, $rules);

        return redirect()->route('admin.products.show', [$product->id])->with('message', 'Product Added!');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param array                    $rules
     *
     * @return static
     */
    protected function runSave(Request $request, array $rules)
    {

        $this->validate($request, array_merge([
            //'intro_text' => 'required',
        ], $rules));
        $product = Product::create($request->all());

        if ($request->has('enabled')) {
            $product->enabled = true;
        } else {
            $product->enabled = false;
        }

        if ($request->has('featured')) {
            $product->featured = true;
        } else {
            $product->featured = false;
        }
        if ($request->has('categories')) {
            $product->categories()->dissociate();
            $categoryModel = Category::whereId($request->get('categories'))->first();
            $product->categories()->associate($categoryModel);
        }

        $product->save();

        return $product;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Product             $product
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, Request $request)
    {
        $rules = [
            'name' => 'bail|required',
        ];

        $this->runUpdate($request, $rules, $product);

        return redirect()->route('admin.products.show', $product->id)->with('message', 'Product updated!');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param array                    $rules
     * @param \App\Product             $product
     *
     * @return static
     */
    protected function runUpdate(Request $request, array $rules, Product $product)
    {
        $this->validate($request, array_merge([
            //'intro_text' => 'required',
        ], $rules));

        $product->fill($request->except('enabled'));

        if ($request->has('enabled')) {
            $product->enabled = true;
        } else {
            $product->enabled = false;
        }

        if ($request->has('featured')) {
            $product->featured = true;
        } else {
            $product->featured = false;
        }

        if ($request->has('categories')) {
            $product->categories()->dissociate();
            $categoryModel = Category::whereId($request->get('categories'))->first();
            $product->categories()->associate($categoryModel);
        }

        $product->save();

        return $product;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $product->delete();

        return redirect()->route('admin.products.index')->with('message', 'Product deleted!');
    }


    /**
     * @param \App\Product $product
     * @param              $imageId
     *
     * @return mixed
     * @throws \Spatie\MediaLibrary\Exceptions\MediaDoesNotBelongToModel
     */
    public function defaultImage(Product $product, $imageId)
    {
        $image = $product->getMedia('products')->all();
        if (count($image) > 0) {
            foreach ($image as $theImage) {
                $theImage->custom_properties = ['default' => false];
                $theImage->save();
            }
        }

        $image = $product->media->find($imageId);
        $image->custom_properties = ['default' => true];
        $image->save();

        return redirect()->back()->with('message', 'Image Set as Default!')->with('message', 'Image Set as Default!');
    }


    /**
     * @param \App\Product $product
     * @param              $imageId
     *
     * @return mixed
     * @throws \Spatie\MediaLibrary\Exceptions\MediaDoesNotBelongToModel
     */
    public function deleteImage(Product $product, $imageId)
    {
        $product->deleteMedia($imageId);

        return redirect()->back()->with('message', 'Image deleted!');
    }


    /**
     * @param \App\Product $product
     * @param              $imageId
     *
     * @return mixed
     * @throws \Spatie\MediaLibrary\Exceptions\MediaDoesNotBelongToModel
     */
    public function deleteAccessoryImage(Product $product, $imageId)
    {
        $product->deleteMedia($imageId);

        return redirect()->back()->with('message', 'Image deleted!');
    }


    /**
     * @param \App\Product             $product
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function addImage(Product $product, Request $request)
    {

        if ($request->hasFile('qqfile')) {
            $product->addMedia($request->file('qqfile'))->preservingOriginal()->toCollection('products');
        }

        return response()->json(['success' => 'true']);
    }


    /**
     * @param \App\Product             $product
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function addAccessoryImage(Product $product, Request $request)
    {

        if ($request->hasFile('qqfile')) {
            $product->addMedia($request->file('qqfile'))->preservingOriginal()->toCollection('accessories');
        }

        return response()->json(['success' => 'true']);
    }


    /**
     * @param \App\Product             $product
     * @param \Illuminate\Http\Request $request
     */
    public function moveUp(Product $product, Request $request)
    {

        $product->moveHigher();

        return redirect()->back()->with('message', 'Product ' . $product->name . ' Moved Higher!');
    }


    /**
     * @param \App\Product             $product
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveToTop(Product $product, Request $request)
    {
        $product->moveToTop();

        return redirect()->back()->with('message', 'Product ' . $product->name . ' Moved to Top!');
    }


    /**
     * @param \App\Product             $product
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveToBottom(Product $product, Request $request)
    {
        $product->moveToBottom();

        return redirect()->back()->with('status', 'Product '. $product->name . ' Moved to Bottom!');
    }


    /**
     * @param \App\Product             $product
     * @param \Illuminate\Http\Request $request
     */
    public function moveDown(Product $product, Request $request)
    {

        $product->moveLower();

        return redirect()->back()->with('status', 'Product ' . $product->name . ' Moved Lower!');
    }

}
