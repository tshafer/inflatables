<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use League\Fractal;

class UnitController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::with(['product'])->paginate(100);

        return view('admin.units.index', compact('units'));
    }


    /**
     * @param \App\Unit $unit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Unit $unit)
    {
        return view('admin.units.show', compact('unit'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Unit $unit
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {

        $products = Product::get()->pluck('name', 'id')->toArray();

        asort($products);

        $productId = $unit->product->id;

        return view('admin.units.edit', compact('unit', 'products', 'productId'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $products = Product::get()->pluck('name', 'id')->toArray();

        asort($products);

        $productId = null;

        return view('admin.units.create', compact('products', 'productId'));
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
        $rules = [
            'name'    => 'bail|required|unique:units',
            'product' => 'required',
            'price'   => ['required', 'regex:/^\d*(\.\d{2})?$/'],
        ];
        $unit  = $this->runSave($request, $rules);

        return redirect()->route('admin.units.show', [$unit->id])->with('message', 'Unit Added!');
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
        $unit = Unit::create($request->all());

        $unit->save();

        if ($request->has('product')) {
            $product = Product::find($request->get('product'));
            $product->units()->save($unit);
        }

        return $unit;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Unit                $unit
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Unit $unit, Request $request)
    {
        $rules = [
            'name'  => 'bail|required',
            'price' => ['required', 'regex:/^\d*(\.\d{2})?$/'],
        ];
        $this->runUpdate($request, $rules, $unit);

        return redirect()->route('admin.units.show', $unit)->with('message', 'Unit updated!');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param array                    $rules
     * @param \App\Unit                $unit
     *
     * @return static
     */
    protected function runUpdate(Request $request, array $rules, Unit $unit)
    {
        $this->validate($request, array_merge([
            //'intro_text' => 'required',
        ], $rules));

        if ($request->has('product')) {
            $product = Product::find($request->get('product'));
            $unit->product()->associate($product);
        }

        $unit->fill($request->all());

        $unit->save();

        return $unit;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Unit $unit
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {

        $unit->delete();

        return redirect()->route('admin.units.index')->with('message', 'Unit deleted!');
    }

}
