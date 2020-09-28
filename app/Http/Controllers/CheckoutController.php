<?php namespace App\Http\Controllers;

use App\UnitRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * @package App\Http\Controllers
 */
class CheckoutController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {

        if(Cart::instance(session('cartId'))->count() == 0)
            return redirect()->route('home');

        return view('checkout');
    }


    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name'      => 'required',
            'last_name'       => 'required',
            'email'           => 'required|email',
            'phone'           => 'required|regex:/^\+?[^a-zA-Z]{5,}$/',
            'company_website' => 'nullable|url',
        ]);

        $unitRequest       = UnitRequest::create($request->all());
        $unitRequest->cart =  Cart::instance(session('cartId'))->content()->toJson();
        $unitRequest->save();


        foreach (Cart::instance(session('cartId'))->content() as $unit) {
            $unitRequest->units()->attach($unit->id);
        }

        $data = $request->all();

        Mail::send('emails.sendRequest', ['data' => $data, 'cart' => Cart::instance(session('cartId'))->content(), 'units' => $unitRequest], function ($message) {

            $message->subject('Space Walk Sales Requests Form');
            $message->from('sales@spacewalk.com', 'Space Walk Sales Request');
            
            $message->to('admin@spacewalksales.com');

        });


        Cart::instance(session('cartId'))->destroy();

        return redirect()->route('thanks');

    }

}
