<?php namespace App\Http\Controllers;

use App\Product;
use App\Slider;
use App\Special;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        $sliders = Slider::all();

        $featured = Product::with('units', 'categories')->take(6)->orderBy('created_at', 'desc')->enabled()->whereFeatured(true)->get();

        $products = Product::with('units', 'categories')->take(6 - $featured->count())->whereNotIn('id', $featured->pluck('id'))->orderBy('created_at', 'desc')->enabled()->get();

        $products = $featured->merge($products);

        return view('index', compact('sliders', 'products'));
    }


    /**
     * @return mixed
     */
    public function about()
    {
        return view('about');
    }


    /**
     * @return mixed
     */
    public function privacy()
    {
        return view('privacy');
    }


    /**
     * @return mixed
     */
    public function termsConditions()
    {
        return view('terms_conditions');
    }


    /**
     * @return mixed
     */
    public function special()
    {
        $specials = Special::all();
        
        return view('specials', compact('specials'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('contact');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanks()
    {
        return view('thanks');
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function contactPost(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        $data = $request->all();

        Mail::send('emails.send', ['data' => $data], function ($message) {

            $message->subject('Space Walk Sales Contact Form');
            $message->from('sales@spacewalk.com', 'Space Walk Sales Contact Form');
            $message->to('admin@spacewalksales.com');

        });

        return redirect()->route('contact')->with('message', 'Thank you for contacting us. We will be in touch soon.');
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        $query = rtrim(trim($request->get('q')));

        $results = Unit::search('*' . $query)->with(['product.categories'])->paginate();

        return view('results', compact('results', 'query'));

    }
}
