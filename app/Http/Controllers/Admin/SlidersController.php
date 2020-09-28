<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;

class SlidersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::paginate(50);

        return view('admin.sliders.index', compact('sliders'));
    }


    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sliders.create');
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
        $this->validate($request, [
            'title' => 'required',
            'url'   => 'url',
        ]);

        $slider = Slider::create($request->all());

        if ($request->hasFile('image')) {
            $slider->addMedia($request->file('image'))->preservingOriginal()->toCollection('sliders');
        }

        $slider->save();

        return redirect()->route('admin.sliders.show', [$slider->id])->with('message', 'Slider Added!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Slider              $slider
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Slider $slider, Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'url'   => 'url',
        ]);

        $slider->fill($request->except('enabled'));

        $slider->clearMediaCollection();

        if ($request->hasFile('image')) {
            $slider->addMedia($request->file('image'))->preservingOriginal()->toCollection('sliders');
        }

        $slider->save();

        return redirect()->route('admin.sliders.show', $slider->id)->with('message', 'Slider Added!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('admin.sliders.index')->status('message', 'Slider deleted!');
    }


    /**
     * @param \App\Slider $slider
     * @param             $imageId
     *
     * @return mixed
     * @throws \Spatie\MediaLibrary\Exceptions\MediaDoesNotBelongToModel
     */
    public function deleteImage(Slider $slider, $imageId)
    {
        $slider->deleteMedia($imageId);

        return redirect()->back()->with('message', 'Image deleted!');
    }

}
