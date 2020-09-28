<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UnitRequest;

class RequestsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitRequests = UnitRequest::paginate(50);

        return view('admin.requests.index', compact('unitRequests'));
    }


    /**
     * @param \App\UnitRequest $unitRequest
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(UnitRequest $unitRequest)
    {
        $cart = collect(json_decode($unitRequest->cart));

        $total = $cart->pluck('subtotal')->sum();

        return view('admin.requests.show', compact('unitRequest', 'cart', 'total'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param UnitRequest $unitRequest
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitRequest $unitRequest)
    {

        $unitRequest->delete();

        return redirect()->route('admin.unitrequests.index')->with('status', 'Request deleted!');
    }

}
