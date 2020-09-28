<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.create');
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

        $user = User::create($request->all());

        $user->save();

        return redirect()->route('admin.users.show', [$user->id])->with('message', 'User Added!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\User                $user
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, Request $request)
    {
        $user->fill($request->all());

        $user->save();

        return redirect()->route('admin.users.show', $user->id)->with('message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id != Auth::user()->id) {
        
            $user->delete();

            return redirect()->route('admin.users.index')->with('message', 'User deleted!');
        }

        return redirect()->route('admin.users.index')->with('message', 'You can not delete yourself.');
    }

}
